-- =========================================================
-- Projet : Touche pas au klaxon
-- Description : Script complet de création et d'initialisation
-- Base : MySQL
-- =========================================================

-- ---------------------------------------------------------
-- Création de la base
-- ---------------------------------------------------------
CREATE DATABASE IF NOT EXISTS touche_pas_au_klaxon
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE touche_pas_au_klaxon;

-- ---------------------------------------------------------
-- Suppression des tables existantes
-- ---------------------------------------------------------
DROP TABLE IF EXISTS trips;
DROP TABLE IF EXISTS agencies;
DROP TABLE IF EXISTS users;

-- ---------------------------------------------------------
-- Table : users
-- ---------------------------------------------------------
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    last_name VARCHAR(100) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(191) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('USER', 'ADMIN') NOT NULL DEFAULT 'USER',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Table : agencies
-- ---------------------------------------------------------
CREATE TABLE agencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Table : trips
-- ---------------------------------------------------------
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,
    departure_datetime DATETIME NOT NULL,
    arrival_datetime DATETIME NOT NULL,
    total_places INT NOT NULL,
    available_places INT NOT NULL,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_trips_departure_agency
        FOREIGN KEY (departure_agency_id)
        REFERENCES agencies(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_trips_arrival_agency
        FOREIGN KEY (arrival_agency_id)
        REFERENCES agencies(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_trips_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT chk_trips_different_agencies
        CHECK (departure_agency_id <> arrival_agency_id),

    CONSTRAINT chk_trips_positive_total_places
        CHECK (total_places > 0),

    CONSTRAINT chk_trips_available_places
        CHECK (available_places >= 0 AND available_places <= total_places),

    CONSTRAINT chk_trips_dates
        CHECK (arrival_datetime > departure_datetime)
);

-- ---------------------------------------------------------
-- Insertion des agences
-- ---------------------------------------------------------
INSERT INTO agencies (name) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- ---------------------------------------------------------
-- Insertion des utilisateurs
-- Mot de passe temporaire pour tous : 1234
-- ---------------------------------------------------------
INSERT INTO users (last_name, first_name, phone, email, password, role) VALUES
('Martin','Alexandre','0612345678','alexandre.martin@email.fr','1234','ADMIN'),
('Dubois','Sophie','0698765432','sophie.dubois@email.fr','1234','USER'),
('Bernard','Julien','0622446688','julien.bernard@email.fr','1234','USER'),
('Moreau','Camille','0611223344','camille.moreau@email.fr','1234','USER'),
('Lefèvre','Lucie','0777889900','lucie.lefevre@email.fr','1234','USER'),
('Leroy','Thomas','0655443322','thomas.leroy@email.fr','1234','USER'),
('Roux','Chloé','0633221199','chloe.roux@email.fr','1234','USER'),
('Petit','Maxime','0766778899','maxime.petit@email.fr','1234','USER'),
('Garnier','Laura','0688776655','laura.garnier@email.fr','1234','USER'),
('Dupuis','Antoine','0744556677','antoine.dupuis@email.fr','1234','USER'),
('Lefebvre','Emma','0699887766','emma.lefebvre@email.fr','1234','USER'),
('Fontaine','Louis','0655667788','louis.fontaine@email.fr','1234','USER'),
('Chevalier','Clara','0788990011','clara.chevalier@email.fr','1234','USER'),
('Robin','Nicolas','0644332211','nicolas.robin@email.fr','1234','USER'),
('Gauthier','Marine','0677889922','marine.gauthier@email.fr','1234','USER'),
('Fournier','Pierre','0722334455','pierre.fournier@email.fr','1234','USER'),
('Girard','Sarah','0688665544','sarah.girard@email.fr','1234','USER'),
('Lambert','Hugo','0611223366','hugo.lambert@email.fr','1234','USER'),
('Masson','Julie','0733445566','julie.masson@email.fr','1234','USER'),
('Henry','Arthur','0666554433','arthur.henry@email.fr','1234','USER');

-- ---------------------------------------------------------
-- Insertion de trajets de test
-- ---------------------------------------------------------
INSERT INTO trips (
    departure_agency_id,
    arrival_agency_id,
    departure_datetime,
    arrival_datetime,
    total_places,
    available_places,
    user_id
) VALUES
(1, 2, '2026-05-10 08:00:00', '2026-05-10 12:00:00', 4, 3, 1),
(2, 1, '2026-05-11 09:00:00', '2026-05-11 13:00:00', 3, 2, 2),
(3, 4, '2026-05-12 07:30:00', '2026-05-12 11:30:00', 5, 4, 3),
(5, 9, '2026-05-13 10:00:00', '2026-05-13 14:00:00', 4, 1, 4),
(10, 7, '2026-05-14 06:45:00', '2026-05-14 10:15:00', 2, 2, 5);

-- ---------------------------------------------------------
-- Vérifications rapides
-- ---------------------------------------------------------
-- SELECT * FROM agencies;
-- SELECT * FROM users;
-- SELECT * FROM trips;