<h1 class="mb-4">Modifier une agence</h1>

<form method="post" action="/admin/agencies/<?= (int) $agency['id'] ?>/update" class="card p-4 shadow-sm">
    <div class="mb-3">
        <label for="name" class="form-label">Nom de l’agence</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="<?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?>"
            required
        >
    </div>

    <button type="submit" class="btn btn-dark">Enregistrer</button>
</form>