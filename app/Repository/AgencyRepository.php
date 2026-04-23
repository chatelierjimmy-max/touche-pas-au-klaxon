<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use PDO;

final class AgencyRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM agencies ORDER BY name ASC');

        return $statement->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM agencies WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);

        $agency = $statement->fetch();

        return $agency ?: null;
    }

    public function create(string $name): void
    {
        $statement = $this->pdo->prepare('INSERT INTO agencies (name) VALUES (:name)');
        $statement->execute(['name' => $name]);
    }

    public function update(int $id, string $name): void
    {
        $statement = $this->pdo->prepare('UPDATE agencies SET name = :name WHERE id = :id');
        $statement->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM agencies WHERE id = :id');
        $statement->execute(['id' => $id]);
    }
}