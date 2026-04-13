<?php

use App\Core\Auth;
use App\Core\Flash;

$flash = Flash::get();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Application', ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>
    <header>
        <h2>Touche pas au klaxon</h2>

        <?php if (!Auth::check()): ?>
            <a href="/login">Connexion</a>
        <?php else: ?>
            <?php if (Auth::isAdmin()): ?>
                <a href="/">Tableau de bord</a>
            <?php else: ?>
                <a href="/trips/create">Créer un trajet</a>
            <?php endif; ?>

            <span>
                Bonjour <?= htmlspecialchars(Auth::user()['first_name'] . ' ' . Auth::user()['last_name'], ENT_QUOTES, 'UTF-8') ?>
            </span>

            <a href="/logout">Déconnexion</a>
        <?php endif; ?>

        <hr>
    </header>

    <?php if ($flash !== null): ?>
        <div>
            <strong><?= htmlspecialchars(strtoupper($flash['type']), ENT_QUOTES, 'UTF-8') ?> :</strong>
            <?= htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8') ?>
        </div>
        <hr>
    <?php endif; ?>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <hr>
        <p>© 2024 - CENEF</p>
    </footer>
</body>
</html>