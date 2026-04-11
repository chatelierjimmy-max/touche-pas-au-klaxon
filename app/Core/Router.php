<?php

declare(strict_types=1);

namespace App\Core;

use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

final class Router
{
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->dispatcher = simpleDispatcher(function ($routeCollector): void {
            require base_path('routes/web.php');
        });
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = rawurldecode(parse_url($uri, PHP_URL_PATH) ?: '/');

        $routeInfo = $this->dispatcher->dispatch($method, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                echo '404 - Page non trouvée';
                return;

            case Dispatcher::METHOD_NOT_ALLOWED:
                http_response_code(405);
                echo '405 - Méthode non autorisée';
                return;

            case Dispatcher::FOUND:
                [, $handler, $vars] = $routeInfo;

                [$controllerClass, $action] = $handler;
                $controller = new $controllerClass();
                $controller->$action(...array_values($vars));
                return;
        }
    }
}