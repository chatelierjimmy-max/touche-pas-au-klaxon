<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Redirect;
use App\Core\View;

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function redirect(string $path): never
    {
        Redirect::to($path);
    }
}