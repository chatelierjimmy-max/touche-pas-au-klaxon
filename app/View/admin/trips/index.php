<h1 class="mb-4">Trajets</h1>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Auteur</th>
                <th>Départ</th>
                <th>Destination</th>
                <th>Date départ</th>
                <th>Date arrivée</th>
                <th>Places</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trips as $trip): ?>
                <tr>
                    <td><?= htmlspecialchars($trip['first_name'] . ' ' . $trip['last_name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($trip['departure_agency'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($trip['arrival_agency'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($trip['departure_datetime'])), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($trip['arrival_datetime'])), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= (int) $trip['available_places'] ?> / <?= (int) $trip['total_places'] ?></td>
                    <td>
                        <form method="post" action="/admin/trips/<?= (int) $trip['id'] ?>/delete" onsubmit="return confirm('Supprimer ce trajet ?');">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>