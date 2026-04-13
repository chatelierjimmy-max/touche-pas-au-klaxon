<?php

use App\Core\Auth;

?>

<h1>Détail du trajet</h1>

<p><strong>Départ :</strong> <?= htmlspecialchars($trip['departure_agency']) ?></p>
<p><strong>Destination :</strong> <?= htmlspecialchars($trip['arrival_agency']) ?></p>

<p><strong>Date départ :</strong> <?= date('d/m/Y H:i', strtotime($trip['departure_datetime'])) ?></p>
<p><strong>Date arrivée :</strong> <?= date('d/m/Y H:i', strtotime($trip['arrival_datetime'])) ?></p>

<p><strong>Places :</strong> <?= (int) $trip['available_places'] ?> / <?= (int) $trip['total_places'] ?></p>

<p><strong>Créé par :</strong>
    <?= htmlspecialchars($trip['first_name'] . ' ' . $trip['last_name']) ?>
</p>

<hr>

<?php if (!Auth::check()): ?>
    <p><a href="/login">Se connecter pour réserver</a></p>

<?php elseif ((int) Auth::user()['id'] === (int) $trip['user_id']): ?>
    <p>
        <a href="/trips/<?= (int) $trip['id'] ?>/edit">Modifier</a>
    </p>

    <form method="post" action="/trips/<?= (int) $trip['id'] ?>/delete" onsubmit="return confirm('Supprimer ce trajet ?');">
        <button type="submit">Supprimer</button>
    </form>

<?php else: ?>
    <p>
        <button disabled>Réserver (à faire)</button>
    </p>
<?php endif; ?>