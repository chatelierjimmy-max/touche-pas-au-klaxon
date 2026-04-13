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
}