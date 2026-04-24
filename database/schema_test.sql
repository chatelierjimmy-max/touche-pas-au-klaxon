USE touche_pas_au_klaxon_test;

DROP TABLE IF EXISTS trips;
DROP TABLE IF EXISTS agencies;
DROP TABLE IF EXISTS users;

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

CREATE TABLE agencies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    departure_agency_id INT NOT NULL,
    arrival_agency_id INT NOT NULL,
    departure_datetime DATETIME NOT NULL,
    arrival_datetime DATETIME NOT NULL,
    total_places INT NOT NULL,
    available_places INT NOT NULL,
    user_id INT NOT NULL,

    CONSTRAINT fk_departure FOREIGN KEY (departure_agency_id) REFERENCES agencies(id),
    CONSTRAINT fk_arrival FOREIGN KEY (arrival_agency_id) REFERENCES agencies(id),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(id)
);