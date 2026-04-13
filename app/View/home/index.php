<h1 class="mb-4">Trajets proposés</h1>

<?php if (empty($trips)): ?>
    <div class="alert alert-info">Aucun trajet disponible</div>
<?php else: ?>

<div class="table-responsive">
    <table class="table table-bordered table-hover bg-white">

        <thead class="table-dark">
        <tr>
            <th>Départ</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Destination</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Places</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr onclick="window.location='/trips/<?= $trip['id'] ?>'" style="cursor:pointer;">
                <td><?= $trip['departure_agency'] ?></td>
                <td><?= date('d/m/Y', strtotime($trip['departure_datetime'])) ?></td>
                <td><?= date('H:i', strtotime($trip['departure_datetime'])) ?></td>
                <td><?= $trip['arrival_agency'] ?></td>
                <td><?= date('d/m/Y', strtotime($trip['arrival_datetime'])) ?></td>
                <td><?= date('H:i', strtotime($trip['arrival_datetime'])) ?></td>
                <td><?= $trip['available_places'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php endif; ?>