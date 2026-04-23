<?php

use App\Core\Auth;
?>

<header class="border rounded-pill px-4 py-3 mb-4 bg-white">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="mb-0">
            <a href="/" class="text-dark text-decoration-none fw-bold">
                Touche pas au klaxon
            </a>
        </h4>

        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-end">
            <?php if (!Auth::check()): ?>
                <a href="/login" class="btn btn-dark">Connexion</a>
            <?php else: ?>
                <span>
                    Bonjour <?= htmlspecialchars(Auth::user()['first_name'] . ' ' . Auth::user()['last_name'], ENT_QUOTES, 'UTF-8') ?>
                </span>

                <?php if (Auth::isAdmin()): ?>
                    <a href="/admin" class="btn btn-secondary">Dashboard</a>
                    <a href="/admin/users" class="btn btn-outline-dark">Utilisateurs</a>
                    <a href="/admin/agencies" class="btn btn-outline-dark">Agences</a>
                    <a href="/admin/trips" class="btn btn-outline-dark">Trajets</a>
                <?php else: ?>
                    <a href="/trips/create" class="btn btn-dark">Créer un trajet</a>
                <?php endif; ?>

                <a href="/logout" class="btn btn-outline-dark">Déconnexion</a>
            <?php endif; ?>
        </div>
    </div>
</header>