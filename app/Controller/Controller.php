<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Redirect;
use App\Core\View;

/**
 * Classe abstraite de base pour tous les contrôleurs.
 *
 * Fournit des méthodes utilitaires communes :
 * - affichage des vues
 * - redirections HTTP
 *
 * Tous les contrôleurs de l'application doivent étendre cette classe.
 */
abstract class Controller
{
    /**
     * Affiche une vue avec les données associées.
     *
     * Cette méthode délègue le rendu à la classe View.
     *
     * @param string $view Nom de la vue à afficher (ex : 'home/index').
     * @param array<string, mixed> $data Données à transmettre à la vue.
     * @return void
     */
    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    /**
     * Effectue une redirection HTTP vers une autre route.
     *
     * Cette méthode termine immédiatement l'exécution du script.
     *
     * @param string $path Chemin de redirection (ex : '/login').
     * @return never
     */
    protected function redirect(string $path): never
    {
        Redirect::to($path);
    }
}