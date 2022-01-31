# CV-zone

## Présentation

CV-zone est une plateforme web d'annonces de jobs pour étudiants dans le but de faciliter les recherches de stage ou bien de contrat en alternance. Il s'agit d'un projet demandé par l'Université de Rouen.

## Technologies

Ce projet est fait en PHP ( >= 5.0) et utilise MySQL comme base de données.

## Fonctionnalités

- Espace de connexion/inscription
- Création et publication de son CV (espace étudiant)
- Création et publication de l'offre de stage/alternance (espace entreprise)
- Gestion du compte utilisateur
    - Consultation et modification du CV/jobs 
    - Modification des informations personnelles
- Fonction de recherche
- Page de contact (gestion d'envoi de mails)

## Installation

### Etape 1 : importation du schéma SQL

Une fois votre base de données créer, importer le fichier SQL "cvzonedb.sql" présent à la racine du projet afin d'y créer l'ensemble des tables nécessaires au bon fonctionnement de la plateforme.

### Etape 2 : connexion à la base de données

Depuis le répertoire "**scripts**" ouvrer le fichier **config.php**.

```php
<?php
try {
    $user = 'IDENTIFIANT DE LA BDD';
    $pass = 'MOT DE PASSE DE LA BDD';
    $bdd = new PDO('mysql:host=HOST DE LA BDD;dbname=NOM DE LA BDD', $user, $pass);
} ...
?>
```

Par la suite, changer les informations de connexion inscrit en majuscules par celles de votre base de données et sauvegarder le fichier.

| Variables  | Détails  |
|---|---|
| HOST DE LA BDD  | IP de votre serveur SQL  |
| NOM DE LA BDD  | Nom de votre base de données  | 
| $user  | Identifiant de votre base de données |
| $pass | Mot de passe de votre base de données | 

### Etape 3 : installation des modules Composer

Certains modules PHP sont nécessaires au bon fonctionnement de certaines fonctionnalités de la plateforme.

Assurez-vous d'avoir [Composer](https://getcomposer.org/) d'installer sur votre poste de travail et exécuter la commande suivante depuis votre invite de commande via la racine du projet :

```sh
composer install
```

Patientez jusqu'à la fin de l'installation des modules.

Liste des modules composer installées :

- PHPMailer (permet l'envoi de mails pour la page de contact)

### Etape 4 : Envoyer les fichiers vers le serveur

Une fois les étapes précédentes effectuées, envoyer l'ensemble des fichiers depuis le FTP de votre serveur web. Manque plus qu'à tester depuis l'URL de votre site internet !

## Démo

Une démonstration est disponible depuis l'URL suivante (via un hébergeur gratuit) :

https://cvzone.quentinsavean.fr
