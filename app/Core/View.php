<?php

declare(strict_types=1);

namespace App\Core;

final class View
{
    /**
    * Affiche une vue dans le layout principal.
    *
    * @param string $view Nom de la vue.
    * @param array<string, mixed> $data Données transmises à la vue.
    * @return void
    */
    public static function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = view_path($view . '.php');

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("Vue introuvable : {$view}");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require view_path('layouts/app.php');
    }
}