<?php

declare(strict_types=1);

namespace App\Core;

use App\Middleware\MiddlewareInterface;
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

                $middlewares = [];
                if (isset($handler['middlewares'])) {
                    $middlewares = $handler['middlewares'];
                }

                $controllerClass = $handler['controller'];
                $method = $handler['method'];

                $this->runMiddlewares($middlewares);

                $controller = new $controllerClass();
                $vars = $this->castRouteParams($vars);

                $controller->$method(...array_values($vars));
                return;
        }
    }

    /**
    * Exécute les middlewares liés à une route.
    *
     * @param array<int, class-string<\App\Middleware\MiddlewareInterface>> $middlewares
     * @return void
    */
    private function runMiddlewares(array $middlewares): void
    {
        foreach ($middlewares as $middlewareClass) {
            $middleware = new $middlewareClass();

            $middleware->handle();
        }
    }

    /**
    * Convertit les paramètres numériques de route en entiers.
     *
    * @param array<string, string> $vars
    * @return array<string, int|string>
    */
    private function castRouteParams(array $vars): array
    {
        foreach ($vars as $key => $value) {
            if (ctype_digit($value)) {
                $vars[$key] = (int) $value;
            }
        }

        return $vars;
    }
}