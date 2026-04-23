<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;

final class AdminMiddleware implements MiddlewareInterface
{
    public function handle(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        if (!Auth::isAdmin()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }
}