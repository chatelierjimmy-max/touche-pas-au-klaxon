<?php

use App\Core\Auth;
use App\Core\Flash;

$flash = Flash::get();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Application') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <!-- HEADER -->
    <header class="border rounded-pill px-4 py-3 mb-4 bg-white">
        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <h4 class="mb-0">
                <a href="/" class="text-dark text-decoration-none">
                    Touche pas au klaxon
                </a>
            </h4>

            <div class="d-flex align-items-center gap-2 flex-wrap">
                <?php if (!Auth::check()): ?>
                    <a href="/login" class="btn btn-dark">Connexion</a>

                <?php else: ?>
                    <span>
                        Bonjour <?= htmlspecialchars(Auth::user()['first_name']) ?>
                    </span>

                    <a href="/trips/create" class="btn btn-dark">Créer</a>
                    <a href="/logout" class="btn btn-outline-dark">Déconnexion</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <!-- FLASH -->
    <?php if ($flash): ?>
        <div class="alert <?= $flash['type'] === 'success' ? 'alert-success' : 'alert-danger' ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <!-- CONTENT -->
    <main>
        <?= $content ?>
    </main>

    <!-- FOOTER -->
    <footer class="text-center mt-5">
        <p>© 2024 - CENEF</p>
    </footer>

</div>

</body>
</html>