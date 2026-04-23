<?php

declare(strict_types=1);
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'Application', ENT_QUOTES, 'UTF-8') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-4">

    <?php require view_path('partials/header.php'); ?>

    <?php require view_path('partials/flash.php'); ?>

    <main>
        <?= $content ?>
    </main>

    <?php require view_path('partials/footer.php'); ?>

</div>

</body>
</html>