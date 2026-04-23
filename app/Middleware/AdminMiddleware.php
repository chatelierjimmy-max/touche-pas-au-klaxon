<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;

/**
 * Middleware de contrôle d'accès administrateur.
 *
 * Vérifie que l'utilisateur :
 * - est connecté
 * - possède le rôle ADMIN
 *
 * Si ces conditions ne sont pas respectées :
 * - redirige vers la page de connexion (si non connecté)
 * - renvoie une erreur 403 (si non administrateur)
 */
final class AdminMiddleware implements MiddlewareInterface
{
    /**
     * Exécute la vérification des droits administrateur.
     *
     * @return void
     */
    public function handle(): void
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }

        // Vérifie si l'utilisateur est administrateur
        if (!Auth::isAdmin()) {
            http_response_code(403);
            echo 'Accès interdit';
            exit;
        }
    }
}