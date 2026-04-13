<h1>Créer un trajet</h1>

<p>
    Utilisateur : 
    <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name'], ENT_QUOTES, 'UTF-8') ?>
    -
    <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>
</p>

<form method="post" action="/trips">
    <div>
        <label for="departure_agency_id">Agence de départ</label><br>
        <select name="departure_agency_id" id="departure_agency_id" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= (int) $agency['id'] ?>">
                    <?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label for="arrival_agency_id">Agence d'arrivée</label><br>
        <select name="arrival_agency_id" id="arrival_agency_id" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($agencies as $agency): ?>
                <option value="<?= (int) $agency['id'] ?>">
                    <?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <br>

    <div>
        <label for="departure_date">Date de départ</label><br>
        <input type="date" name="departure_date" id="departure_date" required>
    </div>

    <br>

    <div>
        <label for="departure_time">Heure de départ</label><br>
        <input type="time" name="departure_time" id="departure_time" required>
    </div>

    <br>

    <div>
        <label for="arrival_date">Date d'arrivée</label><br>
        <input type="date" name="arrival_date" id="arrival_date" required>
    </div>

    <br>

    <div>
        <label for="arrival_time">Heure d'arrivée</label><br>
        <input type="time" name="arrival_time" id="arrival_time" required>
    </div>

    <br>

    <div>
        <label for="total_places">Nombre total de places</label><br>
        <input type="number" name="total_places" id="total_places" min="1" required>
    </div>

    <br>

    <button type="submit">Créer</button>
</form>