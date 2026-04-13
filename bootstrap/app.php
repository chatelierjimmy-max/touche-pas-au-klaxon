<?php

use App\Core\Database;
use App\Core\Env;
use App\Core\Session;

require_once __DIR__ . '/../vendor/autoload.php';

Env::load(base_path());
Session::start();
Database::init(config('database'));

?>