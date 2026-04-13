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

    public function dispatch(string $httpMethod, string $uri): void
    {
        $uri = rawurldecode(parse_url($uri, PHP_URL_PATH) ?: '/');
        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);

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
                [$controllerClass, $method] = $handler;

                $controller = new $controllerClass();

                $vars = $this->castRouteParams($vars);

                $controller->$method(...array_values($vars));
                return;
        }
    }

    private function castRouteParams(array $vars): array
    {
        foreach ($vars as $key => $value) {
            if (is_string($value) && ctype_digit($value)) {
                $vars[$key] = (int) $value;
            }
        }

        return $vars;
    }
}