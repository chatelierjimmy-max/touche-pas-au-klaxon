<?php

declare(strict_types=1);

use App\Core\Env;
use App\Core\Session;

require_once __DIR__ . '/../vendor/autoload.php';

Env::load(base_path());
Session::start();