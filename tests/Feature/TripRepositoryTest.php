<?php

declare(strict_types=1);

namespace Tests\Feature;

require_once __DIR__ . '/DatabaseTestCase.php';

use App\Repository\TripRepository;

/**
 * Tests des opérations d'écriture du repository des trajets.
 */
final class TripRepositoryTest extends DatabaseTestCase
{
    public function testCreateTrip(): void
    {
        $userId = $this->createUser();
        $departureAgencyId = $this->createAgency('Paris');
        $arrivalAgencyId = $this->createAgency('Lyon');

        $repository = new TripRepository();

        $repository->create([
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
            'departure_datetime' => '2026-05-10 08:00:00',
            'arrival_datetime' => '2026-05-10 12:00:00',
            'total_places' => 4,
            'available_places' => 4,
            'user_id' => $userId,
        ]);

        $stmt = $this->pdo->query("SELECT * FROM trips");
        $trip = $stmt->fetch();

        $this->assertNotFalse($trip);
        $this->assertSame(4, (int) $trip['total_places']);
        $this->assertSame($userId, (int) $trip['user_id']);
    }

    public function testUpdateTrip(): void
    {
        $userId = $this->createUser();
        $departureAgencyId = $this->createAgency('Paris');
        $arrivalAgencyId = $this->createAgency('Lyon');

        $stmt = $this->pdo->prepare("
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
        ");

        $stmt->execute([
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
            'departure_datetime' => '2026-05-10 08:00:00',
            'arrival_datetime' => '2026-05-10 12:00:00',
            'total_places' => 4,
            'available_places' => 4,
            'user_id' => $userId,
        ]);

        $tripId = (int) $this->pdo->lastInsertId();

        $newDepartureAgencyId = $this->createAgency('Marseille');
        $newArrivalAgencyId = $this->createAgency('Toulouse');

        $repository = new TripRepository();

        $repository->update($tripId, [
            'departure_agency_id' => $newDepartureAgencyId,
            'arrival_agency_id' => $newArrivalAgencyId,
            'departure_datetime' => '2026-05-11 09:00:00',
            'arrival_datetime' => '2026-05-11 13:00:00',
            'total_places' => 5,
            'available_places' => 3,
        ]);

        $stmt = $this->pdo->prepare("SELECT * FROM trips WHERE id = :id");
        $stmt->execute(['id' => $tripId]);
        $trip = $stmt->fetch();

        $this->assertNotFalse($trip);
        $this->assertSame(5, (int) $trip['total_places']);
        $this->assertSame(3, (int) $trip['available_places']);
        $this->assertSame($newDepartureAgencyId, (int) $trip['departure_agency_id']);
    }

    public function testDeleteTrip(): void
    {
        $userId = $this->createUser();
        $departureAgencyId = $this->createAgency('Paris');
        $arrivalAgencyId = $this->createAgency('Lyon');

        $stmt = $this->pdo->prepare("
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
        ");

        $stmt->execute([
            'departure_agency_id' => $departureAgencyId,
            'arrival_agency_id' => $arrivalAgencyId,
            'departure_datetime' => '2026-05-10 08:00:00',
            'arrival_datetime' => '2026-05-10 12:00:00',
            'total_places' => 4,
            'available_places' => 4,
            'user_id' => $userId,
        ]);

        $tripId = (int) $this->pdo->lastInsertId();

        $repository = new TripRepository();
        $repository->delete($tripId);

        $stmt = $this->pdo->prepare("SELECT * FROM trips WHERE id = :id");
        $stmt->execute(['id' => $tripId]);
        $trip = $stmt->fetch();

        $this->assertFalse($trip);
    }
}