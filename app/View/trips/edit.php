<h1>Modifier un trajet</h1>

<form method="post" action="/trips/<?= (int) $trip['id'] ?>/update">
    <div>
        <label for="departure_agency_id">Agence de départ</label><br>
        <select name="departure_agency_id" id="departure_agency_id" required>
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= (int) $agency['id'] ?>" <?= (int) $agency['id'] === (int) $trip['departure_agency_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label for="arrival_agency_id">Agence d'arrivée</label><br>
        <select name="arrival_agency_id" id="arrival_agency_id" required>
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= (int) $agency['id'] ?>" <?= (int) $agency['id'] === (int) $trip['arrival_agency_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label for="departure_date">Date de départ</label><br>
        <input type="date" name="departure_date" id="departure_date" value="<?= htmlspecialchars(date('Y-m-d', strtotime($trip['departure_datetime'])), ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <br>

    <div>
        <label for="departure_time">Heure de départ</label><br>
        <input type="time" name="departure_time" id="departure_time" value="<?= htmlspecialchars(date('H:i', strtotime($trip['departure_datetime'])), ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <br>

    <div>
        <label for="arrival_date">Date d'arrivée</label><br>
        <input type="date" name="arrival_date" id="arrival_date" value="<?= htmlspecialchars(date('Y-m-d', strtotime($trip['arrival_datetime'])), ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <br>

    <div>
        <label for="arrival_time">Heure d'arrivée</label><br>
        <input type="time" name="arrival_time" id="arrival_time" value="<?= htmlspecialchars(date('H:i', strtotime($trip['arrival_datetime'])), ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <br>

    <div>
        <label for="total_places">Nombre total de places</label><br>
        <input type="number" name="total_places" id="total_places" min="1" value="<?= (int) $trip['total_places'] ?>" required>
    </div>

    <br>

    <button type="submit">Enregistrer</button>
</form>