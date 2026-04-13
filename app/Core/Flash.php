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

    public static function get(): ?array
    {
        $flash = Session::get(self::KEY);
        Session::forget(self::KEY);

        return $flash;
    }
}