<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\User\User;
use Grav\Common\Uri;

/**
 * Class CasLinkPlugin
 * @package Grav\Plugin
 */
class CasLinkPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Initialize the plugin and enable events based on context (Admin or Site).
     */
    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            $this->enable([
                // For injecting the CAS login URL into Admin Twig
                'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
                // Core logic for ticket validation after redirect from CAS
                'onPageInitialized' => ['onPageInitialized', 0],
            ]);
        } else {
            $this->enable([
                // For injecting the CAS login URL on the frontend login page
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                // Note: onPageInitialized is disabled for the frontend for security unless needed for non-admin CAS login
            ]);
        }
    }

    /**
     * Gets the base CAS URL and the service URL for the current request.
     * @return array{casUrl: string, serviceUrl: string}
     */
protected function getCasUrls(): array
    {
        $config = $this->config->get('plugins.cas-link');
        
        // The CAS URL used for user redirects (e.g., https://cas.mydomain.com)
        $casUrl = rtrim($config['cas_server'] ?? '', '/');
        
        // The CAS URL used for server-to-server validation (essential for Docker networking)
        // If cas_validation_server is not set, we fall back to cas_server
        $casValidationUrl = rtrim($config['cas_validation_server'] ?? $casUrl, '/');

        /** @var Uri $uri */
        $uri = $this->grav['uri'];

        // Service URL for redirect back to Grav
        $serviceUrl = $config['serviceUrl'] ?? $uri->url(true);

        return [
            'casUrl' => $casUrl, 
            'casValidationUrl' => $casValidationUrl,
            'serviceUrl' => $serviceUrl
        ];
    }

    /**
     * Expose the CAS login URL to the Admin Twig environment.
     * @param \Grav\Common\Event\AddTwigTemplatePathsEvent $event
     */
    public function onAdminTwigTemplatePaths(&$event)
    {
        $paths = $event['paths'];
        $paths[] = __DIR__ . '/templates/admin-templates';
        $event['paths'] = $paths;

        $config = $this->config->get('plugins.cas-link');
        $casUrl = rtrim($config['cas_server'], '/');
        $serviceUrl = $config['serviceUrl'] ?? $this->grav['uri']->url(true);
        $loginUrl = $casUrl . '/login?service=' . urlencode($serviceUrl);

        $this->grav['twig']->twig_vars['cas_login_url'] = $loginUrl;
    }

    public function onTwigSiteVariables(): void
    {
        $uri = $this->grav['uri'];
        $config = $this->config->get('plugins.cas-link');

        if (strpos($uri->path(), 'login') !== false) {
            $casUrl = rtrim($config['cas_server'], '/');
            $serviceUrl = $config['serviceUrl'] ?? $uri->url(true);
            $loginUrl = $casUrl . '/login?service=' . urlencode($serviceUrl);

            $this->grav['twig']->twig_vars['cas_login_url'] = $loginUrl;
        }
    }


    /**
     * Core logic for CAS ticket validation and user authentication.
     * Runs when an admin page is initialized and a 'ticket' is present.
     */
    public function onPageInitialized(): void
    {
        /** @var Uri $uri */
        
         /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $ticket = $uri->query('ticket');
        
        // Only proceed if we are in the admin panel and a CAS ticket is present.
        if (!$this->isAdmin() || !$ticket) {
            return;
        }

        $urls = $this->getCasUrls();

        $validateUrl = 
            $urls['casValidationUrl'] . 
            '/cas/serviceValidate?service=' . 
            urlencode($urls['serviceUrl']) . 
            '&ticket=' . 
            urlencode($ticket);

        $xml = $this->validateTicket($validateUrl);

        if (!$xml) {
            print '[CAS] Failed to validate ticket or retrieve XML. Redirecting to clear ticket.';
            $this->grav->redirect('/admin');
            return;
        }

        $username = $this->extractUsernameFromXml($xml);

        if (!$username) {
            print '[CAS] Ticket validation failed: no valid username found in response.';
            $this->grav->redirect('/admin');
            return;
        }

        $this->authenticateUser($username);

        // Redirect to the clean admin dashboard URL (strips the ticket parameter)
        $this->grav->redirect('/admin');
    }

    /**
     * Validates the ticket against the CAS server using native PHP methods (cURL or file_get_contents).
     * @param string $validateUrl
     * @return string|null XML response body or null on failure.
     */
    protected function validateTicket(string $validateUrl): ?string
    {
        $xml = null;

        // 1. Try cURL first (generally preferred for remote requests)
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $validateUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                // WARNING: Disabling peer verification is only for development/testing environments like localhost.
                // In production, you must configure your server to trust the CAS server's certificate.
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => false, 
                CURLOPT_TIMEOUT => 5,
            ]);
            $xml = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                print '[CAS] cURL Error: ' . curl_error($ch);
                $xml = null; // Ensure XML is null on failure
            }
            curl_close($ch);
        }

        // 2. Fallback to file_get_contents if cURL is not available or failed
        if (!$xml && ini_get('allow_url_fopen')) {
            $context = stream_context_create([
                'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
                'http' => ['timeout' => 5],
            ]);
            
            // Suppress warnings from file_get_contents and handle failure
            $xml = @file_get_contents($validateUrl, false, $context);

            if ($xml === false) {
                print '[CAS] Failed to retrieve validation XML via file_get_contents.';
                $xml = null;
            }
        }
        
        return $xml;
    }

    /**
     * Extracts the username from the CAS serviceValidate XML response.
     * @param string $xml
     * @return string|null
     */
    protected function extractUsernameFromXml(string $xml): ?string
    {
        try {
            // Suppress error in case of bad XML format
            $parsed = @new \SimpleXMLElement($xml); 
            
            if ($parsed === false) {
                print '[CAS] SimpleXMLElement failed to parse XML.';
                return null;
            }

            $namespaces = $parsed->getNamespaces(true);
            // Get the root element using the CAS namespace
            $serviceResponse = $parsed->children($namespaces['cas'] ?? null);

            // Check for success and extract username
            if (isset($serviceResponse->authenticationSuccess->user)) {
                return (string)$serviceResponse->authenticationSuccess->user;
            }

            // Check for failure
            if (isset($serviceResponse->authenticationFailure)) {
                $message = (string)$serviceResponse->authenticationFailure;
                print '[CAS] Ticket validation failed: ' . $message;
                return null;
            }

        } catch (\Exception $e) {
            print '[CAS] XML parse error: ' . $e->getMessage();
            return null;
        }
        
        return null;
    }

    /**
     * Loads or creates the Grav user and sets the authenticated state.
     * @param string $username
     */
    protected function authenticateUser(string $username): void
    {
        /** @var \Grav\Common\User\User $user */
        $user = User::load($username);

        if (!$user->exists()) {
            $user = new User([
                'username' => $username,
                'email' => $username . '@cas.local',
                'fullname' => $username,
                'state' => 'enabled',
                'access' => [
                    'admin' => ['login' => true, 'super' => false],
                    'site' => ['login' => true],
                ],
            ]);
        }

        $user->authenticated = true;
        $user->authorized = true;

        // Store in session correctly
        $session = $this->grav['session'];
        $session->start();
        $session->user = $user;
    }
}
