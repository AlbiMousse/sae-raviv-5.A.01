# SAE-RAVIV-5.A.01
Réalisation du projet RAVIV  

**SAÉ 5.A.01 — Année 2024-2025**  
**Licence : MPL-2.0**

Ce fichier `README.md` présente notre projet de SAE 5.A.01, ainsi que les différents livrables et réalisations effectués.

---

## 1. Équipe et rôles  

Projet réalisé par :  

| **Équipe de travail**     | **Rôle**        |
|----------------------------|-----------------|
| [Laguilliez Mathys](https://github.com/LaguilliezMathys)          | Développeur     |
| [Aussenac Thomas]()            | Product Owner   |
| [Martinez Quentin](https://github.com/Quentin158)           | Scrum Master    |
| [Estienne Alban-Moussa](https://github.com/AlbiMousse)      | Développeur     |
| [Giard--Pellat Jules](https://github.com/Cracotte-Mu-Da)         | Développeur     |
| [Jockin Victor](https://github.com/victorjockin)              | Responsable Développeur     |

**Tuteurs de l’équipe :**  
- Yahn Formanczak  
- Pascal Sotin  
- Esther Pendariès  
- Ludo Pradel  

Ce travail est à destination d’**Élodie Ducéré**, notre contact avec l’association [**Raviv**](https://www.raviv-tlse.org).

---

## 2. Sujet du projet  

Ce projet consiste en l’unification du système d’authentification des différentes applications : NAS, forum, blog…

---

## 3. Livrables  

Liste de tous les livrables rédigés :  

| **Date**   | **Nom**         | **Lien**                                     |
|------------|-----------------|----------------------------------------------|
| Sem.36 | Document utilisateur    | [Document Utilisateur](https://albimousse.github.io/sae-raviv-5.A.01/docuser.html)     |
| | Document technique| [Document Technique](https://albimousse.github.io/sae-raviv-5.A.01/doctech.html)|
| | Document conception| [Document de Conception](https://albimousse.github.io/sae-raviv-5.A.01/docconcept.html)|
| Sem.37 / 38 | Template du portail de connexion    | [Template du portail de connexion](https://github.com/AlbiMousse/sae-raviv-5.A.01/blob/main/login-portal-template/login.html)     |
| | Environnement de travail| [Environnement de travail](https://github.com/AlbiMousse/sae-raviv-5.A.01/blob/main/infra/docker-compose.yml)|


---

## 4. Réalisations  

Nous mettons à disposition plusieurs documents pour aider à comprendre et utiliser notre projet.  

> Les sections 4.1 à 4.3 concernent les documentatiions, qui sont toutes accessibles sur [GitHub Pages](https://albimousse.github.io/sae-raviv-5.A.01/).

### 4.1. 📘 Document de Conception  
Destinée aux développeurs et contributeurs techniques. Elle décrit la conception du système, avec des diagrammes UML détaillés et les cas d’utilisation principaux.  
🔗 Lien : [Document de Conception](https://albimousse.github.io/sae-raviv-5.A.01/docconcept.html)

### 4.2. 🛠️ Documentation Technique  
Destinée aux développeurs et contributeurs techniques. Elle contient des informations détaillées sur l’architecture, le code et les technologies utilisées.  
🔗 Lien : [Documentation Technique](https://albimousse.github.io/sae-raviv-5.A.01/doctech.html)

### 4.3. 🧑‍💻 Documentation Utilisateur
Destinée aux utilisateurs finaux. Elle explique comment utiliser le projet et ses fonctionnalités.  
🔗 Lien : [Documentation Utilisateur](https://albimousse.github.io/sae-raviv-5.A.01/docuser.html)  

### 4.4. ✅ Cahier de Test
Ce document détaille les cas de test pour valider les fonctionnalités du projet en fonction des rôles définis (visiteur, client, administrateur). Chaque cas de test comprend les préconditions, actions à réaliser et résultats attendus.  
🔗 Lien : Cahier de Test
> *Le cahier de test sera rédigé lorsque la solution définitive aura été choisie.*

### 4.5. ✅ Chiffrage du projet  
Ce document détaille le coût du projet en termes de temps de travail pour l'équipe, ainsi que par membre.
🔗 Lien : Chiffrage du projet 
> *Le chiffrage sera établi à l'issue de la réunion avec **Élodie Ducéré** et **Valentin Grimaud** prévue mercredi 17 septembre 2025.*

---

## 5. Gestion de projet & Qualité  

Pour faciliter le suivi, nous avons mis en place plusieurs outils sur GitHub :  

### 5.1. 🗒️ Board GitHub  
Notre board permet de suivre l’état d’avancement des tâches. Il est organisé en trois colonnes :  

- 📝 **À faire** : Liste des tâches à réaliser  
- ⏳ **En cours** : Tâches en cours de réalisation  
- ✅ **Terminé** : Tâches terminées  

🔗 Lien : [Board](https://github.com/users/AlbiMousse/projects/1)  

### 5.2. 🎯 Milestones  
Les milestones représentent chaque sprint du projet, avec leurs objectifs, délais et un avancement mesuré en pourcentage. 

🔗 Lien : [Milestones](https://github.com/AlbiMousse/sae-raviv-5.A.01/milestones)  

### 5.3. 🚀 Release
La dernière version de notre travail est disponible via le lien ci-dessous.

🔗 Lien : [v0.1](https://github.com/AlbiMousse/sae-raviv-5.A.01/releases/tag/v0.1)

### 5.4. Réunions

Cette section regroupe les ordres du jour et compte rendus de chaque réunion réalisée avec le client.

| **DATE** | **ORDRE DU JOUR** | **COMPTE RENDU** |
|----------|:-----------------:|:----------------:|
| Jeudi 4 Septembre 2025 | [ODJ1](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/ODJ1.pdf) | [CR1](https://github.com/AlbiMousse/sae-raviv-5.A.01/tree/main/docs/meetings/CR1.pdf) |

### 6. Piste de solution envisagé
Pour le développement de ce CAS, nous avons le choix entre différentes solutions :

- **Apereo CAS** est un système de CAS qui fonctionne en Java sur le serveur local. Il permet la gestion des accès entre plusieurs applications/sites, que ce soit PHP, Apache, Python, Node ou Java. Il peut utiliser un annuaire LDAP ou une base de données.
- **Intégration SSO/LDAP YuNoHost** permet également la gestion des accès entre plusieurs applications/sites. Cette solution est plus appropriée pour le projet, car l'existant est hébergé avec YuNoHost. Il utilise son propre LDAP (et comme il existe actuellement plusieurs comptes, nous pouvons simplement les récupérer). Il permettra également de créer un portail plus simplement vers les différentes applications, en prenant en compte les droits et accès des comptes.

|Solution|Avantage|Inconvénients|
|--------|--------|-------------|
|Apereo CAS|- Solution robuste et éprouvée<br>- Compatible multi-technologies|- Complexité d’installation<br>- Nécessite des compétences Java|
|SSO/LDAP YuNoHost|- Intégration facilitée avec l’existant<br>- Gestion centralisée des comptes|- Moins flexible pour des besoins très spécifiques|

Pour ce projet, l’intégration SSO/LDAP via YuNoHost est privilégiée car elle s’adapte mieux à l’environnement existant et simplifie la gestion des accès.
