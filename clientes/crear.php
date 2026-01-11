<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'] ?? '';
    $apellido1 = $_POST['apellido1'] ?? '';
    $apellido2 = $_POST['apellido2'] ?? '';
    $email = $_POST['email'] ?? '';
    $documento = $_POST['documento'] ?? '';
    $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $cp = $_POST['cp'] ?? '';
    $ciudad = $_POST['ciudad'] ?? '';
    $pais = $_POST['pais'] ?? '';
    $credito = $_POST['credito'] ?? 0;
    $forma_pago = $_POST['forma_pago'] ?? '';

    if ($nombre && $apellido1 && $email) {

        $stmt = $pdo->prepare(
            "INSERT INTO clientes
            (nombre, apellido1, apellido2, email, documento, fecha_nacimiento, telefono, direccion, cp, ciudad, pais, credito, forma_pago)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->execute([
            $nombre,
            $apellido1,
            $apellido2,
            $email,
            $documento,
            $fecha_nacimiento,
            $telefono,
            $direccion,
            $cp,
            $ciudad,
            $pais,
            $credito,
            $forma_pago
        ]);

        header('Location: /proyecto/clientes/index.php');
        exit;

    } else {
        $error = "Completa los campos obligatorios.";
    }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content" class="flex-grow-1">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">Nuevo cliente</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post" class="card shadow p-4">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Primer apellido *</label>
                        <input type="text" name="apellido1" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Segundo apellido</label>
                        <input type="text" name="apellido2" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Documento</label>
                        <input type="text" name="documento" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>

                    <div class="form-group col-md-8">
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>CP</label>
                        <input type="text" name="cp" class="form-control">
                    </div>

                    <div class="form-group col-md-5">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>País</label>
                        <input type="text" name="pais" class="form-control" value="España">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Crédito</label>
                        <input type="number" step="0.01" name="credito" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Forma de pago</label>
                        <select name="forma_pago" class="form-control">
                            <option value="Transferencia">Transferencia</option>
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                    </div>
                </div>
                    <div class ="col-6 container text-center">
                        <button type="submit" class="btn btn-primary">
                        Guardar cliente
                        </button>

                        <a href="/proyecto/clientes/index.php" class="btn btn-secondary">
                        Cancelar
                         </a>
                    </div>


            </form>

        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>


