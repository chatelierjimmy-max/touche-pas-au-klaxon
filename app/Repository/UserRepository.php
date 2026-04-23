<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use PDO;

/**
 * Gère les opérations liées aux utilisateurs en base de données.
 *
 * Cette classe permet :
 * - de récupérer tous les utilisateurs
 * - de rechercher un utilisateur par email
 * - de rechercher un utilisateur par identifiant
 */
final class UserRepository
{
    /**
     * Instance de connexion PDO.
     *
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Initialise le repository avec la connexion à la base de données.
     */
    public function __construct()
    {
        $this->pdo = Database::connection();
    }

    /**
     * Récupère tous les utilisateurs triés par nom et prénom.
     *
     * @return array<int, array<string, mixed>> Liste des utilisateurs.
     */
    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM users ORDER BY last_name ASC, first_name ASC');

        return $statement->fetchAll();
    }

    /**
     * Recherche un utilisateur par son adresse email.
     *
     * Utilisé principalement lors de l'authentification.
     *
     * @param string $email Adresse email de l'utilisateur.
     * @return array<string, mixed>|null Utilisateur trouvé ou null.
     */
    public function findByEmail(string $email): ?array
    {
        $sql = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['email' => $email]);

        $user = $statement->fetch();

        return $user ?: null;
    }

    /**
     * Recherche un utilisateur par son identifiant.
     *
     * @param int $id Identifiant de l'utilisateur.
     * @return array<string, mixed>|null Utilisateur trouvé ou null.
     */
    public function findById(int $id): ?array
    {
        $sql = 'SELECT * FROM users WHERE id = :id LIMIT 1';
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $user = $statement->fetch();

        return $user ?: null;
    }
}