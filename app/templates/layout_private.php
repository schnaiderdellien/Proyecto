<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>DELLIEN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Google Fonts (SB Admin 2 usa Nunito) -->

    

    <link rel="icon"type="image/png"href="/proyecto/web/assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <link href="/proyecto/web/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/proyecto/web/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/proyecto/web/assets/css/oscuro.css">
    
</head>

<body id="page-top">

<?php
/** @var string $contenido */
/** @var array $params */
?> <!-- Para quitar el aviso del params -->

<?= $contenido ?>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Core JS -->
<script src="/proyecto/web/assets/vendor/jquery/jquery.min.js"></script>
<script src="/proyecto/web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/proyecto/web/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/proyecto/web/assets/js/sb-admin-2.min.js"></script>
<script src="/proyecto/web/assets/vendor/chart.js/Chart.min.js"></script>
<?php if (!empty($params['js'])): ?>
    <script src="/proyecto/web/assets/js/validar.js"></script>
    <script src="/proyecto/web/assets/js/<?= $params['js'] ?>"></script>
<?php endif; ?>

</body>
</html>