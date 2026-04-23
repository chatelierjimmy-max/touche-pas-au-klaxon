<?php

declare(strict_types=1);

namespace App\Repository;

use App\Core\Database;
use PDO;

/**
 * Gère les opérations liées aux trajets en base de données.
 *
 * Cette classe permet :
 * - de récupérer les trajets disponibles
 * - de rechercher un trajet par ID
 * - de créer, modifier et supprimer un trajet
 * - de récupérer tous les trajets pour l'administration
 */
final class TripRepository
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
     * Récupère tous les trajets disponibles à venir.
     *
     * Conditions :
     * - nombre de places disponibles > 0
     * - date de départ dans le futur
     *
     * @return array<int, array<string, mixed>> Liste des trajets.
     */
    public function findAvailableUpcomingTrips(): array
    {
        $sql = "
            SELECT
                t.id,
                da.name AS departure_agency,
                aa.name AS arrival_agency,
                t.departure_datetime,
                t.arrival_datetime,
                t.total_places,
                t.available_places
            FROM trips t
            INNER JOIN agencies da ON da.id = t.departure_agency_id
            INNER JOIN agencies aa ON aa.id = t.arrival_agency_id
            WHERE t.available_places > 0
              AND t.departure_datetime > NOW()
            ORDER BY t.departure_datetime ASC
        ";

        return $this->pdo->query($sql)->fetchAll();
    }

    /**
     * Recherche un trajet par son identifiant.
     *
     * Inclut les informations :
     * - agences de départ et d’arrivée
     * - utilisateur ayant créé le trajet
     *
     * @param int $id Identifiant du trajet.
     * @return array<string, mixed>|null Trajet trouvé ou null.
     */
    public function findById(int $id): ?array
    {
        $sql = "
            SELECT
                t.*,
                da.name AS departure_agency,
                aa.name AS arrival_agency,
                u.first_name,
                u.last_name
            FROM trips t
            INNER JOIN agencies da ON da.id = t.departure_agency_id
            INNER JOIN agencies aa ON aa.id = t.arrival_agency_id
            INNER JOIN users u ON u.id = t.user_id
            WHERE t.id = :id
            LIMIT 1
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $trip = $statement->fetch();

        return $trip ?: null;
    }

    /**
     * Crée un nouveau trajet en base de données.
     *
     * @param array<string, mixed> $data Données du trajet.
     * @return void
     */
    public function create(array $data): void
    {
        $sql = "
            INSERT INTO trips (
                departure_agency_id,
                arrival_agency_id,
                departure_datetime,
                arrival_datetime,
                total_places,
                available_places,
                user_id
            ) VALUES (
                :departure_agency_id,
                :arrival_agency_id,
                :departure_datetime,
                :arrival_datetime,
                :total_places,
                :available_places,
                :user_id
            )
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    /**
     * Met à jour un trajet existant.
     *
     * @param int $id Identifiant du trajet à modifier.
     * @param array<string, mixed> $data Nouvelles données du trajet.
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $sql = "
            UPDATE trips
            SET
                departure_agency_id = :departure_agency_id,
                arrival_agency_id = :arrival_agency_id,
                departure_datetime = :departure_datetime,
                arrival_datetime = :arrival_datetime,
                total_places = :total_places,
                available_places = :available_places
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
            'departure_agency_id' => $data['departure_agency_id'],
            'arrival_agency_id' => $data['arrival_agency_id'],
            'departure_datetime' => $data['departure_datetime'],
            'arrival_datetime' => $data['arrival_datetime'],
            'total_places' => $data['total_places'],
            'available_places' => $data['available_places'],
        ]);
    }

    /**
     * Supprime un trajet en base de données.
     *
     * @param int $id Identifiant du trajet à supprimer.
     * @return void
     */
    public function delete(int $id): void
    {
        $sql = "DELETE FROM trips WHERE id = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(['id' => $id]);
    }

    /**
     * Récupère tous les trajets pour l'administration.
     *
     * Inclut les informations :
     * - agences de départ et d’arrivée
     * - utilisateur ayant créé le trajet
     *
     * @return array<int, array<string, mixed>> Liste complète des trajets.
     */
    public function findAllForAdmin(): array
    {
        $sql = "
            SELECT
                t.id,
                da.name AS departure_agency,
                aa.name AS arrival_agency,
                t.departure_datetime,
                t.arrival_datetime,
                t.total_places,
                t.available_places,
                u.first_name,
                u.last_name
            FROM trips t
            INNER JOIN agencies da ON da.id = t.departure_agency_id
            INNER JOIN agencies aa ON aa.id = t.arrival_agency_id
            INNER JOIN users u ON u.id = t.user_id
            ORDER BY t.departure_datetime ASC
        ";

        return $this->pdo->query($sql)->fetchAll();
    }
}