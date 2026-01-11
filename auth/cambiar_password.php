<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>


<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

<div class="container-fluid">


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $actual = $_POST['password_actual'] ?? '';
    $nueva  = $_POST['password_nueva'] ?? '';
    $confirmar = $_POST['password_confirmar'] ?? '';

    if ($nueva !== $confirmar) {
        $error = "Las nuevas contraseñas no coinciden";
    } else {

        // Obtener usuario actual desde la BD
        $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE email = ?");
        $stmt->execute([$_SESSION['usuario']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Comprobar contraseña actual
        if (!$usuario || !password_verify($actual, $usuario['password'])) {
            $error = "La contraseña actual no es correcta";
        } else {

            // Cifrar nueva contraseña
            $hash = password_hash($nueva, PASSWORD_DEFAULT);

            // Actualizar en la BD
            $update = $pdo->prepare(
                "UPDATE usuarios SET password = ? WHERE email = ?"
            );
            $update->execute([$hash, $_SESSION['usuario']]);

            $success = "Contraseña actualizada correctamente";
        }
    }
}
?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<?php if (isset($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<div id="content" class="flex-grow-1">

    <div class="container mt-4 mb-5">

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">

                <h1 class="h3 mb-4 text-gray-800">Cambiar contraseña</h1>

                <div class="card shadow-sm">
                    <div class="card-body">

                        <form method="post">
                            <div class="form-group">
                                <label>Contraseña actual</label>
                                <input type="password" name="password_actual" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Nueva contraseña</label>
                                <input type="password" name="password_nueva" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Confirmar nueva contraseña</label>
                                <input type="password" name="password_confirmar" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Guardar contraseña
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<?php if (isset($success)): ?>
<script>
    $(document).ready(function () {
        $('#passwordChangedModal').modal('show');
    });
</script>
<?php endif; ?>
<div style="height: 30vh;"></div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>