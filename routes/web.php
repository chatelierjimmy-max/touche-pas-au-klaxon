<?php

declare(strict_types=1);

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\TripController;

/** @var \FastRoute\RouteCollector $routeCollector */

$routeCollector->addRoute('GET', '/', [HomeController::class, 'index']);
$routeCollector->addRoute('GET', '/login', [AuthController::class, 'showLogin']);
$routeCollector->addRoute('POST', '/login', [AuthController::class, 'login']);
$routeCollector->addRoute('GET', '/logout', [AuthController::class, 'logout']);
$routeCollector->addRoute('GET', '/trips/create', [TripController::class, 'create']);
$routeCollector->addRoute('POST', '/trips', [TripController::class, 'store']);
$routeCollector->addRoute('GET', '/trips/{id:\d+}', [TripController::class, 'show']);
$routeCollector->addRoute('GET', '/trips/{id:\d+}/edit', [TripController::class, 'edit']);
$routeCollector->addRoute('POST', '/trips/{id:\d+}/update', [TripController::class, 'update']);
$routeCollector->addRoute('POST', '/trips/{id:\d+}/delete', [TripController::class, 'delete']);