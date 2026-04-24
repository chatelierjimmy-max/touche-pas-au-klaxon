## Touche pas au klaxon

Application web de gestion de trajets (covoiturage interne) développée en PHP selon une architecture MVC.

## Présentation

Ce projet permet à des utilisateurs de :

- proposer des trajets
- consulter les trajets disponibles
- gérer leurs propres trajets

Un administrateur dispose d’un panneau dédié pour :

- gérer les utilisateurs
- gérer les agences
- gérer les trajets

## Architecture

Le projet repose sur une architecture MVC (Model - View - Controller) :

app/
├── Controller/
├── Core/
├── Middleware/
├── Repository/
├── View/

### Controller

Gère la logique applicative et les actions utilisateur.

### Repository

Gère les accès à la base de données (PDO).

### View

Gère l’affichage (HTML + Bootstrap).

### Core

Contient les composants principaux :

- Router
- Auth
- Session
- Validator
- Database

### Middleware

Permet de sécuriser les routes :

- AuthMiddleware
- AdminMiddleware
- GuestMiddleware

## Sécurité

- Authentification des utilisateurs
- Gestion des rôles (USER / ADMIN)
- Protection des routes via middleware
- Vérification des droits (propriétaire d’un trajet)
- Utilisation de `password_hash` et `password_verify`

## Fonctionnalités

- Authentification (login / logout)
- Gestion des rôles (admin / utilisateur)
- CRUD des trajets
- Validation des formulaires
- Panneau d’administration
- Middleware (sécurité des routes)
- Affichage des informations via modale
- Réservation de place

## Choix techniques

- PHP 8 avec typage strict
- PDO pour sécuriser les requêtes SQL
- FastRoute pour le routing
- Architecture MVC pour la séparation des responsabilités
- Repository pour isoler la logique SQL
- Validator pour centraliser les validations
- PHPUnit pour tester les écritures en base
- PHPStan pour l’analyse statique

## Script SQL Base de données

Le fichier `database/schema.sql` contient :

- la création de la base
- la création des tables
- les données de test

Tables principales :

- users
- agencies
- trips

Importer ce fichier dans MySQL pour initialiser le projet.

## Modélisation

- MCD : `database/mcd.png`
- MLD : `database/mld.txt`
- Script SQL : `database/schema.sql`

## Installation

## 1. Cloner le projet

git clone https://github.com/chatelierjimmy-max/touche-pas-au-klaxon.git
cd touche-pas-au-klaxon

## 2. Installer les dépendances

composer install

## 3. Créer la base de données

Ouvrir phpMyAdmin ou MySQL
Importer le fichier : database/schema.sql

## 4. Configurer le fichier .env

Créer un fichier .env à la racine du projet :

DB_HOST=127.0.0.1
DB_PORT=3308
DB_DATABASE=touche_pas_au_klaxon
DB_USERNAME=root
DB_PASSWORD=

## 5. Lancer le serveur PHP

php -S 127.0.0.1:8000 -t public

## 6. Accéder à l’application

http://127.0.0.1:8000

## 7. Comptes de test

Admin

Email : alexandre.martin@email.fr
Mot de passe : 1234

Utilisateur

Email : sophie.dubois@email.fr
Mot de passe : 1234

## 8. Arrêter le serveur

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
storage/
tests/
vendor/

## Tests

Le projet intègre des tests PHPUnit couvrant les opérations d’écriture en base de données :

- création d’agence
- modification d’agence
- suppression d’agence
- création de trajet
- modification de trajet
- suppression de trajet

## Lancer les tests

.\vendor\bin\phpunit

## Résultat attendu :

OK (6 tests, 13 assertions)

## Base de test

touche_pas_au_klaxon_test

Une base de test dédiée est utilisée afin de ne pas altérer les données principales.

## Analyse statique

Le projet utilise PHPStan pour analyser la qualité du code.

## Lancer l’analyse :

composer phpstan

## Résultat attendu :

[OK] No errors

PHPStan analyse les couches applicatives principales :
Core, Controller, Repository, Middleware, routes et tests.

## Améliorations possibles

- Système de réservation avancé avec table reservations
- Pagination des trajets
- Recherche / filtres
- Interface utilisateur plus avancée
- API REST

## Contexte

Projet réalisé dans le cadre de la formation CEF
Objectif : mise en pratique d’une architecture MVC en PHP avec base de données MySQL

## Auteur

Projet réalisé par châtelier jimmy
