<?php

declare(strict_types=1);

use App\Controller\HomeController;

/** @var \FastRoute\RouteCollector $routeCollector */

$routeCollector->addRoute('GET', '/', [HomeController::class, 'index']);