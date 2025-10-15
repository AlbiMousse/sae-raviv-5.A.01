![GitHub Release](https://img.shields.io/github/v/release/AlbiMousse/sae-raviv-5.A.01?include_prereleases)

# SAE-RAVIV-5.A.01
Réalisation du projet RAVIV  

**SAÉ 5.A.01 — Année 2025-2026**  

Ce fichier `README.md` présente notre projet de SAE 5.A.01, ainsi que les différents livrables et réalisations effectués.

---

## Sommaire
[1. Présentation de l'équipe](#1-présentation-de-léquipe)  
&emsp;[1.1. Équipe de développement](#11-équipe-de-développement)  
&emsp;[1.2. Tuteurs pédagogiques](#12-tuteurs-pédagogiques)  
&emsp;[1.3. Destinataires](#13-destinataires)  
[2. Présentation du projet](#2-présentation-du-projet)  
&emsp;[2.1. Client et contexte](#21-client-et-contexte)  
&emsp;[2.2. Solution proposée](#22-solution-proposée)  
[3. Réalisations et livrables](#3-réalisations-et-livrables)  
&emsp;[3.1. Documents](#31-documents)  
&emsp;&emsp;[3.1.1. Document de conception](#311-document-de-conception)  
&emsp;&emsp;[3.1.2. Documentation technique](#312-documentation-technique)  
&emsp;&emsp;[3.1.3. Documentation utilisateur](#313-documentation-utilisateur)  
&emsp;&emsp;[3.1.4. Cahier de test](#314-cahier-de-test)  
&emsp;&emsp;[3.1.5. Chiffrage du projet](#315-chiffrage-du-projet)  
&emsp;[3.2. Tableau des livrables](#32-tableau-des-livrables)  
&emsp;[3.3. Releases](#33-releases)  
[4. Gestion de projet](#4-gestion-de-projet)  
&emsp;[4.1. Board GitHub](#41-board-github)  
&emsp;[4.2. Milestones](#42-milestones)  
&emsp;[4.3. Réunions](#43-réunions)  
[5. Planning de télétravail](#5-planning-de-télétravail)  
&emsp;[5.1. Légende](#51-légende)  
&emsp;[5.2. Planning](#52-planning)  

---

## 1. Présentation de l'équipe

### 1.1. Équipe de développement

| **Équipe de travail**     | **Rôle**        |
|----------------------------|-----------------|
| [Laguilliez Mathys](https://github.com/LaguilliezMathys) | Développeur |
| [Aussenac Thomas](https://github.com/Ssauth) | Product Owner |
| [Martinez Quentin](https://github.com/Quentin158) | Scrum Master |
| [Estienne Alban-Moussa](https://github.com/AlbiMousse) | Développeur |
| [Giard--Pellat Jules](https://github.com/Cracotte-Mu-Da) | Développeur |
| [Jockin Victor](https://github.com/victorjockin) | Responsable Développeur |

### 1.2. Tuteurs pédagogiques
- Yahn Formanczak  
- Pascal Sotin  
- Esther Pendariès  
- Ludo Pradel  

### 1.3. Destinataires

L'ensemble du travail réalisé est à destination d’**Élodie Ducéré**, notre contact avec l’association [**Raviv**](https://www.raviv-tlse.org).

---

## 2. Présentation du projet

### 2.1. Client et contexte

Ce projet consiste en la création d'un système d'authentification permettant d'unifier les différents outils proposés par RAVIV, à savoir :
- [Le site de l'association](https://getgrav.org)
- [Un forum Discourse](https://www.discourse.org)
- [Un NAS Synology](https://www.synology.com/fr-fr)

RAVIV est un réseau coopératif d’acteurs du spectacle vivant qui œuvre à la mutualisation des espaces de travail, du matériel et des ressources afin de soutenir et développer la création artistique locale dans un esprit de solidarité.

### 2.2. Solution proposée
Pour le développement de ce CAS, nous avons le choix entre différentes solutions :

- **Apereo CAS** est un système de CAS qui fonctionne en Java sur le serveur local. Il permet la gestion des accès entre plusieurs applications/sites, que ce soit PHP, Apache, Python, Node ou Java. Il peut utiliser un annuaire LDAP ou une base de données.
- **Intégration SSO/LDAP YuNoHost** permet également la gestion des accès entre plusieurs applications/sites. Cette solution est plus appropriée pour le projet, car l'existant est hébergé avec YuNoHost. Il utilise son propre LDAP (et comme il existe actuellement plusieurs comptes, nous pouvons simplement les récupérer). Il permettra également de créer un portail plus simplement vers les différentes applications, en prenant en compte les droits et accès des comptes.

|Solution|Avantage|Inconvénients|
|--------|--------|-------------|
|Apereo CAS|- Solution robuste et éprouvée<br>- Compatible multi-technologies|- Complexité d’installation<br>- Nécessite des compétences Java|
|SSO/LDAP YuNoHost|- Intégration facilitée avec l’existant<br>- Gestion centralisée des comptes|- Moins flexible pour des besoins très spécifiques|

Pour ce projet, l’intégration SSO/LDAP via YuNoHost est privilégiée car elle s’adapte mieux à l’environnement existant et simplifie la gestion des accès.

---

## 3. Réalisations et livrables

### 3.1. Documents

Nous mettons à disposition plusieurs documents pour aider à comprendre et utiliser notre projet.  

> Les sections 4.1 à 4.3 concernent les documentatiions, qui sont toutes accessibles sur [GitHub Pages](https://albimousse.github.io/sae-raviv-5.A.01/).

#### 3.1.1. Document de Conception  
Destinée aux développeurs et contributeurs techniques. Elle décrit la conception du système, avec des diagrammes UML détaillés et les cas d’utilisation principaux.  
🔗 Lien : [Document de Conception](https://albimousse.github.io/sae-raviv-5.A.01/docconcept.html)

#### 3.1.2. Documentation Technique  
Destinée aux développeurs et contributeurs techniques. Elle contient des informations détaillées sur l’architecture, le code et les technologies utilisées.  
🔗 Lien : [Documentation Technique](https://albimousse.github.io/sae-raviv-5.A.01/doctech.html)

#### 3.1.3. Documentation Utilisateur
Destinée aux utilisateurs finaux. Elle explique comment utiliser le projet et ses fonctionnalités.  
🔗 Lien : [Documentation Utilisateur](https://albimousse.github.io/sae-raviv-5.A.01/docuser.html)  

#### 3.1.4. Cahier de Recette
Ce document détaille les cas de test pour valider les fonctionnalités du projet en fonction des rôles définis (visiteur, client, administrateur). Chaque cas de test comprend les préconditions, actions à réaliser et résultats attendus.  
🔗 Lien : [Cahier de Recette](https://albimousse.github.io/sae-raviv-5.A.01/recette.html)

#### 3.1.5. Chiffrage du projet  
Ce document détaille le coût du projet en termes de temps de travail pour l'équipe, ainsi que par membre.
🔗 Lien : [Chiffrage du projet](https://github.com/AlbiMousse/sae-raviv-5.A.01/blob/main/docs/chiffrage/Chiffrage.pdf)

### 3.2. Tableau des livrables

| **Date**   | **Nom**         | **Lien**                                     |
|------------|-----------------|----------------------------------------------|
| Sem.36 | Document utilisateur    | [Document Utilisateur](https://albimousse.github.io/sae-raviv-5.A.01/docuser.html)     |
| | Document technique| [Document Technique](https://albimousse.github.io/sae-raviv-5.A.01/doctech.html)|
| | Document conception| [Document de Conception](https://albimousse.github.io/sae-raviv-5.A.01/docconcept.html)|
| Sem.37 / 38 | Template du portail de connexion    | [Template du portail de connexion](https://github.com/AlbiMousse/sae-raviv-5.A.01/blob/main/login-portal-template/login.html)     |
| | Environnement de travail| [Environnement de travail](https://github.com/AlbiMousse/sae-raviv-5.A.01/blob/main/infra/docker-compose.yml)|

### 3.3. Releases

| **DERNIÈRE VERSION** | Publiée le 03/10/2025 | [v0.2](https://github.com/AlbiMousse/sae-raviv-5.A.01/releases/tag/v0.2) |
|----------------------|------------|--------------------------------------------------------------------------|
| | | |
| *ANCIENNE VERSION* | *Publiée le 19/09/2025* | [*v0.1*](https://github.com/AlbiMousse/sae-raviv-5.A.01/releases/tag/v0.1) |

---

## 4. Gestion de projet

Pour faciliter le suivi, nous avons mis en place plusieurs outils sur GitHub :  

### 4.1. Board GitHub  
Le board du projet permet de suivre l’état d’avancement des tâches. Celles-ci sont classés selon trois colonnes :

| 📝 **À faire** | ⏳ **En cours** | ✅ **Terminé** |
|:-:|:-:|:-:|

🔗 Le Board est consultable ici : [Board](https://github.com/users/AlbiMousse/projects/1)  

### 4.2. Milestones  
Les milestones représentent chaque sprint du projet, avec leurs objectifs, délais et un avancement mesuré en pourcentage. 

🔗 Les milestones sont consultables ici : [Milestones](https://github.com/AlbiMousse/sae-raviv-5.A.01/milestones)  

### 4.3. Réunions

Cette section regroupe les ordres du jour et compte rendus de chaque réunion réalisée avec le client.

| **DATE** | **ORDRE DU JOUR** | **COMPTE RENDU** |
|----------|:-----------------:|:----------------:|
| Jeudi 4 Septembre 2025 | [ODJ1](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/ODJ1.pdf) | [CR1](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/CR1.pdf) |
| Mardi 30 Septembre 2025 | [ODJ2](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/ODJ2.pdf) | [CR2](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/CR2.pdf) |

---

## 5. Planning de télétravail

### 5.1. Légende

> **T** = Membre en Télétravail

> **A** = Membre Absent (pour maladie ou autre)

> **—** = Jours non travaillés / non consacrés au projet

### 5.2. Planning

> Dans ce planning, ne sont considérées que les séances de travail en autonomie.

| **SEMAINE 36** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 01/09    | 02/09    | 03/09    | 04/09    | 05/09    |
| | | | | | |
| TA | — | | | | T |
| AE | — | | | | |
| JG | — | | | | | 
| VJ | — | | | | |
| ML | — | | | | T |
| QM | — | | | | |

| **SEMAINE 37** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 08/09    | 09/09    | 10/09    | 11/09    | 12/09    |
| | | | | | |
| TA | | — | T | T | |
| AE | | — | T | | A |
| JG | | — | T | | | 
| VJ | | — | T | | |
| ML | | — | T | T | |
| QM | | — | T | | A |

| **SEMAINE 38** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 15/09    | 16/09    | 17/09    | 18/09    | 19/09    |
| | | | | | |
| TA | | | | T | — |
| AE | | | | T | — |
| JG | | | | T | — | 
| VJ | | | | | — |
| ML | | | | T | — |
| QM | A | | | | — |

| **SEMAINE 39** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 22/09    | 23/09    | 24/09    | 25/09    | 26/09    |
| | | | | | |
| TA | | T | | T | T |
| AE | | | | | T |
| JG | | | | | T |
| VJ | | | | | |
| ML | | T | | | T |
| QM | | | | | |

| **SEMAINE 40** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 29/09    | 30/09    | 01/10    | 02/10    | 03/10    |
| | | | | | |
| TA | | | T | T | T |
| AE | | | | | T |
| JG | | | | | T |
| VJ | | | | | |
| ML | | | T | | T |
| QM | | | | | |

| **SEMAINE 41** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 06/10    | 07/10    | 08/10    | 09/10    | 10/10    |
| | | | | | |
| TA | T | T | T | T | |
| AE | T | | | | |
| JG | | | | | |
| VJ | T | | | | |
| ML | T | | T | T | |
| QM | T | | | | |

| **SEMAINE 41** | **LUN.** | **MAR.** | **MER.** | **JEU.** | **VEN.** |
|:--------------:|:--------:|:--------:|:--------:|:--------:|:--------:|
| **MEMBRE**     | 13/10    | 14/10    | 15/10    | 16/10    | 17/10    |
| | | | | | |
| TA | T | | A | A | |
| AE | | | | | |
| JG | | | | | |
| VJ | | | | | |
| ML | | | | | |
| QM | | | | | |
