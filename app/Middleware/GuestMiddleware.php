<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Core\Auth;
use App\Core\Redirect;

/**
 * Middleware réservé aux utilisateurs non authentifiés (invités).
 *
 * Permet de protéger certaines routes (ex : /login)
 * afin qu'elles ne soient accessibles qu'aux utilisateurs non connectés.
 *
 * Si l'utilisateur est déjà connecté :
 * - redirection vers la page d'accueil
 */
final class GuestMiddleware implements MiddlewareInterface
{
    /**
     * Exécute la vérification d'accès pour les invités.
     *
     * @return void
     */
    public function handle(): void
    {
        if (Auth::check()) {
            Redirect::to('/');
        }
    }
}