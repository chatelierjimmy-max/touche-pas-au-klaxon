<?php

declare(strict_types=1);

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        $base = dirname(__DIR__);

        return $path ? $base . DIRECTORY_SEPARATOR . ltrim($path, '/\\') : $base;
    }
}

if (!function_exists('view_path')) {
    function view_path(string $path = ''): string
    {
        return base_path('app/View/' . ltrim($path, '/\\'));
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/\\');
    }
}

if (!function_exists('config')) {
    function config(string $file): array
    {
        $path = base_path('config/' . $file . '.php');

        if (!file_exists($path)) {
            throw new RuntimeException("Fichier de configuration introuvable : {$file}");
        }

        return require $path;
    }
}