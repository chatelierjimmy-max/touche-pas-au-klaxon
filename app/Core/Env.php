<?php

declare(strict_types=1);

namespace App\Core;

use Dotenv\Dotenv;

final class Env
{
    public static function load(string $path): void
    {
        if (!file_exists($path . '/.env')) {
            return;
        }

        $dotenv = Dotenv::createImmutable($path);
        $dotenv->safeLoad();
    }
}