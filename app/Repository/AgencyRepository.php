<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use PDO;

/**
 * Gère les opérations liées aux agences en base de données.
 *
 * Cette classe permet :
 * - de récupérer toutes les agences
 * - de rechercher une agence par ID
 * - de créer, modifier et supprimer une agence
 */
final class AgencyRepository
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
     * Récupère toutes les agences triées par nom.
     *
     * @return array<int, array<string, mixed>> Liste des agences.
     */
    public function findAll(): array
    {
        $statement = $this->pdo->query('SELECT * FROM agencies ORDER BY name ASC');

        return $statement->fetchAll();
    }

    /**
     * Recherche une agence par son identifiant.
     *
     * @param int $id Identifiant de l'agence.
     * @return array<string, mixed>|null Agence trouvée ou null.
     */
    public function findById(int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM agencies WHERE id = :id LIMIT 1');
        $statement->execute(['id' => $id]);

        $agency = $statement->fetch();

        return $agency ?: null;
    }

    /**
     * Crée une nouvelle agence en base de données.
     *
     * @param string $name Nom de l'agence.
     * @return void
     */
    public function create(string $name): void
    {
        $statement = $this->pdo->prepare('INSERT INTO agencies (name) VALUES (:name)');
        $statement->execute(['name' => $name]);
    }

    /**
     * Met à jour le nom d'une agence existante.
     *
     * @param int $id Identifiant de l'agence.
     * @param string $name Nouveau nom de l'agence.
     * @return void
     */
    public function update(int $id, string $name): void
    {
        $statement = $this->pdo->prepare('UPDATE agencies SET name = :name WHERE id = :id');
        $statement->execute([
            'id' => $id,
            'name' => $name,
        ]);
    }

    /**
     * Supprime une agence en base de données.
     *
     * @param int $id Identifiant de l'agence à supprimer.
     * @return void
     */
    public function delete(int $id): void
    {
        $statement = $this->pdo->prepare('DELETE FROM agencies WHERE id = :id');
        $statement->execute(['id' => $id]);
    }
}