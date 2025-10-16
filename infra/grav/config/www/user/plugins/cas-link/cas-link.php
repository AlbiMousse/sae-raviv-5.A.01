<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\User\User;

class CasLinkPlugin extends Plugin
{
    /**
     * Subscribe to Grav events
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Initialize plugin
     */
    public function onPluginsInitialized(): void
    {
        // Admin context
        if ($this->isAdmin()) {
            $this->enable([
                'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
                'onPageInitialized' => ['onPageInitialized', 0],
            ]);
            return;
        }

        // Frontend context (optional)
        $this->enable([
            'onAdminTwigTemplatePaths' => ['onAdminTwigTemplatePaths', 0],
            'onPageInitialized' => ['onPageInitialized', 0],
        ]);
    }

    /**
     * Inject Twig variable for CAS login link (frontend)
     */
    public function onTwigSiteVariables(): void
    {
        $uri = $this->grav['uri'];
        $config = $this->config->get('plugins.cas-link');

        if (strpos($uri->path(), 'login') !== false) {
            $casUrl = rtrim($config['cas_server'], '/');
            $serviceUrl = $uri->url(true);
            $loginUrl = $casUrl . '/login?service=' . urlencode($serviceUrl);

            $this->grav['twig']->twig_vars['cas_login_url'] = $loginUrl;
        }
    }

    /**
     * Inject Twig variable for CAS login link (Admin)
     */
    public function onAdminTwigTemplatePaths(&$event)
    {
        // Add plugin templates path
        $paths = $event['paths'];
        $paths[] = __DIR__ . '/templates/admin-templates';
        $event['paths'] = $paths;

        // Set CAS login URL for Twig
        $uri = $this->grav['uri'];
        $config = $this->config->get('plugins.cas-link');

        $casUrl = rtrim($config['cas_server'], '/');
        $serviceUrl = $uri->url(true);
        $loginUrl = $casUrl . '/login?service=' . urlencode($serviceUrl);

        $this->grav['twig']->twig_vars['cas_login_url'] = $loginUrl;
    }


    /**
     * Handle CAS ticket validation (works for frontend or admin)
     */
    public function onPageInitialized(): void
    {
        $uri = $this->grav['uri'];
        $ticket = $uri->param('ticket') ?: $uri->query('ticket');
        $config = $this->config->get('plugins.cas-link');

        if (!$ticket) {
            return;
        }

        $serviceUrl = $uri->url(true);
        $casUrl = rtrim($config['cas_server'], '/');

        // Validate CAS ticket
        $validateUrl = $casUrl . '/serviceValidate?service=' . urlencode($serviceUrl) . '&ticket=' . urlencode($ticket);
        $response = @file_get_contents($validateUrl);

        if ($response && strpos($response, 'authenticationSuccess') !== false) {
            preg_match('/<user>(.*?)<\/user>/', $response, $matches);
            $username = $matches[1] ?? null;

            if ($username) {
                // Create or load Grav user
                $user = User::load($username);
                if (!$user->exists()) {
                    // Create a temporary in-memory user if not found
                    $user = new User($username);
                    $user->authenticated = true;
                    $user->authorized = true;
                }

                // Authenticate
                $user->authenticated = true;
                $user->authorized = true;
                $this->grav['user'] = $user;

                // Redirect to admin or site home
                if ($this->isAdmin()) {
                    $this->grav->redirect('/admin');
                } else {
                    $this->grav->redirect('/');
                }
            }
        } else {
            // Failed validation → return to login
            $redirect = $this->isAdmin() ? '/admin' : '/login';
            $this->grav->redirect($redirect);
        }
    }
}
