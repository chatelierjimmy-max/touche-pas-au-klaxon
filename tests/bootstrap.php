<?php

declare(strict_types=1);

use App\Core\Database;

require_once __DIR__ . '/../vendor/autoload.php';

Database::reset();

Database::init([
    'host' => '127.0.0.1',
    'port' => 3308,
    'database' => 'touche_pas_au_klaxon_test',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
]);