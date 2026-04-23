<?php

declare(strict_types=1);

namespace App\Middleware;

/**
 * Interface des middlewares.
 *
 * Définit le contrat que tous les middlewares doivent respecter.
 * Chaque middleware doit implémenter la méthode handle()
 * qui sera exécutée lors du traitement d'une requête.
 */
interface MiddlewareInterface
{
    /**
     * Exécute le middleware.
     *
     * Cette méthode contient la logique de contrôle (authentification,
     * autorisation, redirection, etc.).
     *
     * @return void
     */
    public function handle(): void;
}