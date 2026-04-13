<h1>Trajets proposés</h1>

<?php if (empty($trips)): ?>
    <p>Aucun trajet disponible</p>
<?php else: ?>

<table border="1">
    <thead>
        <tr>
            <th>Départ</th>
            <th>Date départ</th>
            <th>Heure départ</th>
            <th>Destination</th>
            <th>Date arrivée</th>
            <th>Heure arrivée</th>
            <th>Places disponibles</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr style="cursor:pointer;">
                <td><?= htmlspecialchars($trip['departure_agency']) ?></td>
                <td><?= date('d/m/Y', strtotime($trip['departure_datetime'])) ?></td>
                <td><?= date('H:i', strtotime($trip['departure_datetime'])) ?></td>
                <td><?= htmlspecialchars($trip['arrival_agency']) ?></td>
                <td><?= date('d/m/Y', strtotime($trip['arrival_datetime'])) ?></td>
                <td><?= date('H:i', strtotime($trip['arrival_datetime'])) ?></td>
                <td><?= (int) $trip['available_places'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>