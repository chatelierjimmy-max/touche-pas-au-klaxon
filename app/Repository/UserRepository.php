<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use PDO;

final class UserRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM users ORDER BY last_name ASC, first_name ASC');

        return $statement->fetchAll();
    }

    public function findByEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['email' => $email]);

        $user = $statement->fetch();

        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = 'SELECT * FROM users WHERE id = :id LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $user = $statement->fetch();

        return $user ?: null;
    }
}