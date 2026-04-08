<?php ob_start(); ?>

<div class="text-center">

    <h4 class="text-muted"><?= htmlspecialchars($params['fecha']) ?></h4>

    <h1 class="mt-3"><?= htmlspecialchars($params['mensaje']) ?></h1>

    <p class="lead mt-3">
        <?= htmlspecialchars($params['mensaje2']) ?>
    </p>

    <p> <?= htmlspecialchars($params['pass']??'')?> </p>

</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/layout_public.php'; ?>