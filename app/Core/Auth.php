<?php

declare(strict_types=1);

namespace App\Core;

use App\Repository\UserRepository;

final class Auth
{
    public static function attempt(string $email, string $password): bool
    {
        $repository = new UserRepository();
        $user = $repository->findByEmail($email);

        if ($user === null) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        Session::put('user', [
            'id' => $user['id'],
            'last_name' => $user['last_name'],
            'first_name' => $user['first_name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ]);

        return true;
    }

    public static function user(): ?array
    {
        return Session::get('user');
    }

    public static function check(): bool
    {
        return self::user() !== null;
    }

    public static function isAdmin(): bool
    {
        $user = self::user();

        return $user !== null && $user['role'] === 'ADMIN';
    }

    public static function logout(): void
    {
        Session::forget('user');
    }
}