<?php

declare(strict_types=1);

use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\TripController;
use App\Controller\Admin\DashboardController;
use App\Controller\Admin\UserController as AdminUserController;
use App\Controller\Admin\AgencyController as AdminAgencyController;
use App\Controller\Admin\TripController as AdminTripController;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

/** @var \FastRoute\RouteCollector $routeCollector */

$routeCollector->addRoute('GET', '/', [
    'controller' => HomeController::class,
    'method' => 'index',
    'middlewares' => [],
]);

$routeCollector->addRoute('GET', '/login', [
    'controller' => AuthController::class,
    'method' => 'showLogin',
    'middlewares' => [GuestMiddleware::class],
]);

$routeCollector->addRoute('POST', '/login', [
    'controller' => AuthController::class,
    'method' => 'login',
    'middlewares' => [GuestMiddleware::class],
]);

$routeCollector->addRoute('GET', '/logout', [
    'controller' => AuthController::class,
    'method' => 'logout',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('GET', '/trips/create', [
    'controller' => TripController::class,
    'method' => 'create',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('POST', '/trips', [
    'controller' => TripController::class,
    'method' => 'store',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('GET', '/trips/{id:\d+}', [
    'controller' => TripController::class,
    'method' => 'show',
    'middlewares' => [],
]);

$routeCollector->addRoute('GET', '/trips/{id:\d+}/edit', [
    'controller' => TripController::class,
    'method' => 'edit',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('POST', '/trips/{id:\d+}/update', [
    'controller' => TripController::class,
    'method' => 'update',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('POST', '/trips/{id:\d+}/delete', [
    'controller' => TripController::class,
    'method' => 'delete',
    'middlewares' => [AuthMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin', [
    'controller' => DashboardController::class,
    'method' => 'index',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin/users', [
    'controller' => AdminUserController::class,
    'method' => 'index',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin/agencies', [
    'controller' => AdminAgencyController::class,
    'method' => 'index',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin/agencies/create', [
    'controller' => AdminAgencyController::class,
    'method' => 'create',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('POST', '/admin/agencies', [
    'controller' => AdminAgencyController::class,
    'method' => 'store',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin/agencies/{id:\d+}/edit', [
    'controller' => AdminAgencyController::class,
    'method' => 'edit',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('POST', '/admin/agencies/{id:\d+}/update', [
    'controller' => AdminAgencyController::class,
    'method' => 'update',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('POST', '/admin/agencies/{id:\d+}/delete', [
    'controller' => AdminAgencyController::class,
    'method' => 'delete',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('GET', '/admin/trips', [
    'controller' => AdminTripController::class,
    'method' => 'index',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('POST', '/admin/trips/{id:\d+}/delete', [
    'controller' => AdminTripController::class,
    'method' => 'delete',
    'middlewares' => [AdminMiddleware::class],
]);

$routeCollector->addRoute('POST', '/trips/{id:\d+}/reserve', [
    'controller' => TripController::class,
    'method' => 'reserve',
    'middlewares' => [AuthMiddleware::class],
]);