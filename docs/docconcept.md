# Document de conception

<img src="assets/img/raviv.png" alt="RAVIV" width="300px">

---

## Sommaire
[1. Architecture générale](#1-architecture-générale)  
[2. Conception](#2-conception)  
&emsp;[2.1. Présentation de la soluation](#21-présentation-de-la-solution)  
&emsp;&emsp;[2.1.1. Maquettes](#211-maquettes)  
&emsp;[2.2. Réalisation de la solution](#22-réalisation-de-la-solution)  
[3. Contraintes techniques](#3-contraintes-techniques)

---

## 1. Architecture générale
## 2. Conception
### 2.1 Présentation de la solution
#### 2.1.1. Maquettes

| ![Figure 2.1.1 - Maquette du portail de connexion aux services RAVIV](/assets/img/mockups/mockup-CAS.png) |
|:-:|
| Figure 2.1.1 - Maquette du portail de connexion aux services RAVIV |

### 2.2 Réalisation de la solution

| ![Figure 2.2.1 - Architecture de la solution](/assets/img/diagrams/gad.png) |
|:-:|
| Figure 2.2.1 - Architecture de la solution |

## 3. Contraintes techniques

Dans le cadre de ce projet, nous avons fait le choix de simuler l'ensemble des outils utilisés par l'association RAVIV plutôt que de travailler directement sur l'environnement de production.

Cette décision a été motivée par des considérations de sécurité et de conformité RGPD. Le prestataire de l'association n'a pas souhaité nous donner un accès direct aux données personnelles des adhérents, afin de respecter au maximum les réglementations en vigueur sur la protection des données.

Pour répondre à cette contrainte tout en permettant le développement et les tests de notre solution, nous avons eu recours à **Docker** pour créer un environnement de simulation complet. Cette approche nous a permis de reproduire fidèlement l'écosystème technique de RAVIV (serveur LDAP, forum Discourse, NAS Nextcloud, site web) sans compromettre la confidentialité des données réelles.

---

**Auteurs**  
Thomas Aussenac  
Alban-Moussa Estienne  
Jules Giard--Pellat  
Victor Jockin  
Mathys Laguilliez  
Quentin Martinez  

***BUT Informatique 3ème Année***  
*IUT de Blagnac, Université Toulouse II - Jean Jaurès (31)*

**Destinataire**  
RAVIV