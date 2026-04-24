<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Core\Database;
use PDO;
use PHPUnit\Framework\TestCase;

/**
 * Classe de base pour les tests liés à la base de données.
 */
abstract class DatabaseTestCase extends TestCase
{
    protected PDO $pdo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pdo = Database::connection();
        $this->cleanTables();
    }

    /**
     * Vide les tables utiles avant chaque test.
     *
     * @return void
     */
    protected function cleanTables(): void
    {
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
        $this->pdo->exec('TRUNCATE TABLE trips');
        $this->pdo->exec('TRUNCATE TABLE agencies');
        $this->pdo->exec('TRUNCATE TABLE users');
        $this->pdo->exec('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Insère un utilisateur de test.
     *
     * @return int
     */
    protected function createUser(): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO users (last_name, first_name, phone, email, password, role)
            VALUES (:last_name, :first_name, :phone, :email, :password, :role)
        ");

        $stmt->execute([
            'last_name' => 'Martin',
            'first_name' => 'Alexandre',
            'phone' => '0612345678',
            'email' => 'alexandre.test@email.fr',
            'password' => password_hash('1234', PASSWORD_DEFAULT),
            'role' => 'USER',
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    /**
     * Insère une agence de test.
     *
     * @param string $name Nom de l'agence.
     * @return int Identifiant de l'agence créée.
     */
    protected function createAgency(string $name): int
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO agencies (name)
            VALUES (:name)
        ");

        $stmt->execute(['name' => $name]);

        return (int) $this->pdo->lastInsertId();
    }
}