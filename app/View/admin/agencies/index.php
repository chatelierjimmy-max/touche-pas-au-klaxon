<h1 class="mb-4">Agences</h1>

<p>
    <a href="/admin/agencies/create" class="btn btn-dark">Créer une agence</a>
</p>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agencies as $agency): ?>
                <tr>
                    <td><?= htmlspecialchars($agency['name'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="d-flex gap-2">
                        <a href="/admin/agencies/<?= (int) $agency['id'] ?>/edit" class="btn btn-secondary btn-sm">Modifier</a>

                        <form method="post" action="/admin/agencies/<?= (int) $agency['id'] ?>/delete" onsubmit="return confirm('Supprimer cette agence ?');">
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>