<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;
use App\Core\Redirect;

/**
 * Middleware de contrôle d'authentification.
 *
 * Vérifie que l'utilisateur est connecté avant d'accéder à une route protégée.
 *
 * Si l'utilisateur n'est pas authentifié :
 * - redirection vers la page de connexion
 */
final class AuthMiddleware implements MiddlewareInterface
{
    /**
     * Exécute la vérification d'authentification.
     *
     * @return void
     */
    public function handle(): void
    {
        if (!Auth::check()) {
            Redirect::to('/login');
        }
    }
}