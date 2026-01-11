<?php
session_start();
date_default_timezone_set('Europe/Madrid');

require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$token = $_GET['token'] ?? '';
$error = null;
$success = null;

// Comprobar token
$stmt = $pdo->prepare(
    "SELECT id FROM usuarios 
     WHERE reset_token = ? 
     AND reset_expira > NOW()"
);
$stmt->execute([$token]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Si el token no es válido
if (!$usuario) {
    $error = "El enlace no es válido o ha expirado.";
}

// Procesar nueva contraseña
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $usuario) {

    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    if ($password !== $confirm) {
        $error = "Las contraseñas no coinciden.";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $update = $pdo->prepare(
            "UPDATE usuarios 
             SET password = ?, reset_token = NULL, reset_expira = NULL 
             WHERE id = ?"
        );
        $update->execute([$hash, $usuario['id']]);

        $success = "Contraseña actualizada correctamente. Ya puedes iniciar sesión.";
    }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if ($error): ?>
                <div class="alert alert-danger text-center">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success text-center">
                    <?= $success ?>
                </div>
                <div class="text-center">
                    <a href="/proyecto/auth/login.php">Ir al login</a>
                </div>
            <?php elseif ($usuario): ?>

                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="mb-4">Restablecer contraseña</h4>

                        <form method="post">
                            <div class="form-group">
                                <label>Nueva contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Confirmar contraseña</label>
                                <input type="password" name="confirm" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Guardar contraseña
                            </button>
                        </form>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
