<?php

use App\Core\Auth;
?>

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
            <th>Infos</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($trips as $trip): ?>
            <tr onclick="window.location='/trips/<?= (int) $trip['id'] ?>'" style="cursor:pointer;">
                <td><?= htmlspecialchars($trip['departure_agency']) ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($trip['departure_datetime']))) ?></td>
                <td><?= htmlspecialchars(date('H:i', strtotime($trip['departure_datetime']))) ?></td>
                <td><?= htmlspecialchars($trip['arrival_agency']) ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($trip['arrival_datetime']))) ?></td>
                <td><?= htmlspecialchars(date('H:i', strtotime($trip['arrival_datetime']))) ?></td>
                <td><?= (int) $trip['available_places'] ?></td>

                <td>
                    <?php if (Auth::check()): ?>
                        <button
                            type="button"
                            class="btn btn-sm btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#tripModal<?= (int) $trip['id'] ?>"
                            onclick="event.stopPropagation();"
                        >
                            Infos
                        </button>
                    <?php else: ?>
                        <a href="/login" class="btn btn-sm btn-outline-secondary" onclick="event.stopPropagation();">
                            Connexion
                        </a>
                    <?php endif; ?>
                </td>
            </tr>

            <?php if (Auth::check()): ?>
                <div class="modal fade" id="tripModal<?= (int) $trip['id'] ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Informations du trajet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <p>
                                    <strong>Proposé par :</strong>
                                    <?= htmlspecialchars($trip['first_name'] . ' ' . $trip['last_name']) ?>
                                </p>

                                <p>
                                    <strong>Téléphone :</strong>
                                    <?= htmlspecialchars($trip['phone']) ?>
                                </p>

                                <p>
                                    <strong>Email :</strong>
                                    <?= htmlspecialchars($trip['email']) ?>
                                </p>

                                <p>
                                    <strong>Nombre total de places :</strong>
                                    <?= (int) $trip['total_places'] ?>
                                </p>
                            </div>

                            <!-- 🔥 NOUVEAU FOOTER AVEC RÉSERVATION -->
                            <div class="modal-footer">
                                <?php if ((int) $trip['available_places'] > 0): ?>
                                    <form method="post" action="/trips/<?= (int) $trip['id'] ?>/reserve">
                                        <button type="submit" class="btn btn-success">
                                            Réserver une place
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>
                                        Complet
                                    </button>
                                <?php endif; ?>

                                <button class="btn btn-secondary" data-bs-dismiss="modal">
                                    Fermer
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
        </tbody>

    </table>
</div>

<?php endif; ?>