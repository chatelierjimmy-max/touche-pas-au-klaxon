## Touche pas au klaxon

Application web de gestion de trajets (covoiturage interne) développée en PHP selon une architecture MVC.

## Présentation

Ce projet permet à des utilisateurs de :

proposer des trajets
consulter les trajets disponibles
gérer leurs propres trajets

Un administrateur dispose d’un panneau dédié pour :

gérer les utilisateurs
gérer les agences
gérer les trajets

## Architecture

Le projet repose sur une architecture MVC (Model - View - Controller) :

app/
├── Controller/
├── Core/
├── Middleware/
├── Repository/
├── View/
🔹 Controller

Gère la logique applicative et les actions utilisateur

🔹 Repository

Gère les accès à la base de données (PDO)

🔹 View

Gère l’affichage (HTML + Bootstrap)

🔹 Core

Contient les composants principaux :

Router
Auth
Session
Validator
Database

🔹 Middleware

Permet de sécuriser les routes :

AuthMiddleware
AdminMiddleware
GuestMiddleware

## Sécurité

Authentification des utilisateurs
Gestion des rôles (USER / ADMIN)
Protection des routes via middleware
Vérification des droits (propriétaire d’un trajet)

Projet MVC PHP réalisé dans le cadre de la formation CEF.

## Fonctionnalités

- Authentification (login / logout)
- Gestion des rôles (admin / utilisateur)
- CRUD des trajets
- Validation des formulaires
- Panneau d’administration
- Middleware (sécurité des routes)

## Administrateur

Accès au dashboard admin
Gestion des utilisateurs
CRUD des agences
Suppression des trajets

## Validation des données

Un système de validation centralisé (Validator) permet de :

vérifier les champs obligatoires
valider les emails
contrôler les dates
vérifier les contraintes métier

## Technologies

- PHP 8
- MySQL
- FastRoute
- Bootstrap 5
- Composer
- Git

## Script SQL Base de données

Le fichier `database/schema.sql` contient :

- la création de la base
- la création des tables
- les données de test

users
agencies
trips

Importer ce fichier dans MySQL pour initialiser le projet.

## Modélisation

MCD

voir : database/mcd.png

MLD

Voir : database/mld.txt

Script SQL

Voir : database/schema.sql

database/schema.sql

## Installation

1.  Cloner le projet :

    git clone https://github.com/chatelierjimmy-max/touche-pas-au-klaxon.git

    cd touche-pas-au-klaxon

2.  Intaller les dépendances

    composer install

3.  Créer la base de données

    ouvrir phpMyadmin ou MySQL
    importer le fichier : database/schema.sql

4.  configurer le fichier .env

    Créer un fichier .env à la racine du projet :

    DB_HOST=127.0.0.1
    DB_PORT=3308
    DB_DATABASE=touche_pas_au_klaxon
    DB_USERNAME=root
    DB_PASSWORD=

5.  Lancer le serveur PHP

    php -S 127.0.0.1:8000 -t public

6.  Accéder à l’application

    Ouvrir dans le navigateur :

    http://127.0.0.1:8000

7.  Comptes de test

    Admin :

    Email : alexandre.martin@email.fr
    Mot de passe : 1234

    Utilisateur :
    Email : sophie.dubois@email.fr
    Mot de passe : 1234

    En production, utiliser password_hash()

8.  Arrêter le serveur

    Dans le terminal :

    CTRL + C

## Structure du projet

app/
bootstrap/
config/
database/
docs/
public/
routes/
vendor/

## Tests

Le projet intègre des tests PHPUnit couvrant les opérations d’écriture en base de données :

- création d’agence
- modification d’agence
- suppression d’agence
- création de trajet
- modification de trajet
- suppression de trajet

Lancement :

vendor\bin\phpunit

## Point important pour ton rendu

Des tests PHPUnit ont été ajoutés pour couvrir les opérations d’écriture en base de données, conformément à la consigne. Une base de test dédiée est utilisée afin de ne pas altérer les données principales.

Tests PHPUnit

Le projet intègre des tests PHPUnit couvrant les opérations d’écriture en base de données.

Tests couverts :

- Création d’une agence
- Modification d’une agence
- Suppression d’une agence
- Création d’un trajet
- Modification d’un trajet
- Suppression d’un trajet

Les tests utilisent une base dédiée :

text:

touche_pas_au_klaxon_test

## Améliorations possibles

Système de réservation de places
Pagination des trajets
Recherche / filtres
Interface plus avancée
API REST

## Contexte

Projet réalisé dans le cadre de la formation CENEF
Objectif : mise en pratique d’une architecture MVC en PHP avec base de données MySQL

## Auteur

Projet réalisé par châtelier jimmy
