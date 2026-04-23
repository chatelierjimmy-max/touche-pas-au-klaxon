<?php

declare(strict_types=1);

namespace App\Core;

final class AdminGuard
{
    public static function check(): void
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