# 📚 Système de Gestion de Bibliothèque 

Le **Système de Gestion de Bibliothèque Amélioré** a pour objectif de moderniser la gestion d'une bibliothèque grâce à une approche orientée objet (OOP) et à des fonctionnalités avancées comme l’héritage, optimisant ainsi la conception et l’extensibilité du système.

---

## 🎯 **Contexte du Projet**
Ce projet vise à fournir une solution efficace et intuitive pour gérer :
- Les livres et leurs catégories.
- Les utilisateurs avec des rôles distincts.
- Les réservations et emprunts de livres.
- Les statistiques, rapports et notifications.

---

## 🚀 **Fonctionnalités Backend Attendues**

### 🔐 **Authentification et Autorisation**
- Système sécurisé d’inscription et de connexion.
- Gestion des rôles :  
  - **Administrateur**  
  - **Utilisateur authentifié**  
  - **Visiteur**

### 📚 **Gestion des Livres**
- **CRUD complet** : Ajout, modification, suppression avec métadonnées (titre, auteur, genre, couverture, résumé, etc.).
- **Bonus** : Ajout de l’attribut **image** pour permettre de lier une image de couverture au modèle `Book`.
- Suivi des états des exemplaires : **disponibles**, **empruntés**, ou **réservés**.
- Gestion hiérarchique des catégories grâce à l’héritage (par ex. : "Livre" comme classe parente, "Roman", "Manuel", etc., comme classes enfants).

### 📆 **Réservation, Retours et Notifications**
- Fonction de réservation pour les livres disponibles.
- **Bonus** : Notification par e-mail pour les livres non retournés avant la date limite.  

### 🔍 **Catalogue et Recherche**

- **Bonus** : Recherche avancée en temps réel avec **AJAX**, offrant des résultats instantanés basés sur les filtres (auteur, titre, genre, etc.).

### 📊 **Statistiques et Rapports**
- Visualisation des **livres les plus empruntés** et des **utilisateurs les plus actifs**.
- Génération automatique de **rapports mensuels** sur les emprunts et retours (Bonus).

---

## 👤 **User Stories**

### 🛠️ **En tant qu'Administrateur**
#### Gestion des utilisateurs et rôles :
- Créer un compte sécurisé pour accéder au système.
- Se connecter pour gérer la bibliothèque.
- Attribuer ou modifier les rôles des utilisateurs.

#### Gestion du catalogue de livres :
- Ajouter un livre avec des informations détaillées, y compris une **image de couverture**.
- Modifier les informations d’un livre existant.
- Supprimer un livre obsolète.
- Définir des catégories et sous-catégories.

#### Statistiques, rapports et notifications :
- Consulter les **livres les plus empruntés**.
- Générer des **rapports mensuels** d’activité.
- Recevoir des alertes pour les emprunts dépassés et envoyer des **e-mails de rappel**.

---

### 👥 **En tant qu'Utilisateur Authentifié**
#### Recherche et consultation des livres :
- Rechercher des livres avec des filtres avancés.
- **Voir les résultats instantanés grâce à AJAX.**
- Consulter les détails d’un livre (image, disponibilité).

#### Réservation et emprunt :
- Réserver un livre disponible.
- Enregistrer le retour d’un livre emprunté.
- Recevoir un **e-mail de rappel** en cas de retard.

---

### 👀 **En tant que Visiteur**
#### Consultation du catalogue :
- Parcourir les livres disponibles sans se connecter.
- Consulter les détails d’un livre (titre, auteur, résumé, image, etc.).

#### Inscription :
- Créer un compte pour accéder aux fonctionnalités supplémentaires.

---
