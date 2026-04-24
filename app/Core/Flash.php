<?php

declare(strict_types=1);

namespace App\Core;

final class Flash
{
    private const KEY = '_flash';

    public static function set(string $type, string $message): void
    {
        Session::put(self::KEY, [
            'type' => $type,
            'message' => $message,
        ]);
    }

    /**
    * Récupère le message flash courant.
    *
    * @return array{type: string, message: string}|null
    */
    public static function get(): ?array
    {
        $flash = Session::get(self::KEY);
        Session::forget(self::KEY);

        return $flash;
    }
}