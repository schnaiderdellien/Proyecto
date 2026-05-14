<!DOCTYPE html>
<html lang="es">
<head>

    <link rel="icon"
      type="image/png"
      href="/proyecto/web/assets/img/favicon.png">

    <meta charset="UTF-8">
    <title>DELLIEN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="/proyecto/web/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/proyecto/web/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/proyecto/web/assets/css/oscuro.css">

    <script src="/proyecto/web/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/proyecto/web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-dark">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php?ctl=inicio"> <!-- Logo Dellien -->
            <img src="/proyecto/web/assets/img/logoDellien.png"
            alt="DELLIEN"
            class="logo-navbar"
            style="height: 40px;">
            
        </a>
        <div class="ms-auto">
            <a class="btn btn-light btn-sm" href="index.php?ctl=login">
                Iniciar Sesión
            </a>
        </div>
    </div>
</nav>

<?php
/** @var string $contenido */
/** @var array $params */
?> <!-- Para quitar el aviso del params y $contenido -->

<div class="container mt-5">
    <?= $contenido ?>
</div>

</body>
</html>