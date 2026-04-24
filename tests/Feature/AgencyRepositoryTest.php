<?php

declare(strict_types=1);

namespace Tests\Feature;

require_once __DIR__ . '/DatabaseTestCase.php';

use App\Repository\AgencyRepository;

/**
 * Tests des opérations d'écriture du repository des agences.
 */
final class AgencyRepositoryTest extends DatabaseTestCase
{
    public function testCreateAgency(): void
    {
        $repository = new AgencyRepository();

        $repository->create('Paris');

        $stmt = $this->pdo->query("SELECT * FROM agencies WHERE name = 'Paris'");
        $agency = $stmt->fetch();

        $this->assertNotFalse($agency);
        $this->assertSame('Paris', $agency['name']);
    }

    public function testUpdateAgency(): void
    {
        $agencyId = $this->createAgency('Paris');
        $repository = new AgencyRepository();

        $repository->update($agencyId, 'Lyon');

        $stmt = $this->pdo->prepare("SELECT * FROM agencies WHERE id = :id");
        $stmt->execute(['id' => $agencyId]);
        $agency = $stmt->fetch();

        $this->assertNotFalse($agency);
        $this->assertSame('Lyon', $agency['name']);
    }

    public function testDeleteAgency(): void
    {
        $agencyId = $this->createAgency('Paris');
        $repository = new AgencyRepository();

        $repository->delete($agencyId);

        $stmt = $this->pdo->prepare("SELECT * FROM agencies WHERE id = :id");
        $stmt->execute(['id' => $agencyId]);
        $agency = $stmt->fetch();

        $this->assertFalse($agency);
    }
}