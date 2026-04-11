<?php

declare(strict_types=1);

use App\Core\Router;

require_once __DIR__ . '/../bootstrap/app.php';

$router = new Router();
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);