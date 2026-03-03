<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRM DAW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/proyecto/web/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="/proyecto/web/assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php?ctl=inicio">CRM DAW</a>
        <div class="ms-auto">
            <a class="btn btn-light btn-sm" href="index.php?ctl=login">
                Iniciar Sesión
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <?= $contenido ?>
</div>

</body>
</html>