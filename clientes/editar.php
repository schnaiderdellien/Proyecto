<?php
require $_SERVER ['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER ['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;
$error = null;

if(!$id){
    header('Location: /proyecto/clientes/index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$cliente){
    header ('Location: /proyecto/clientes/index.php');
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

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
    $activo = $_POST['activo'] ?? 1;

    if ($nombre && $apellido1 && $email) {

        $update = $pdo->prepare(
            "UPDATE clientes SET
                nombre = ?,
                apellido1 = ?,
                apellido2 = ?,
                email = ?,
                documento = ?,
                fecha_nacimiento = ?,
                telefono = ?,
                direccion = ?,
                cp = ?,
                ciudad = ?,
                pais = ?,
                credito = ?,
                forma_pago = ?,
                activo = ?
             WHERE id = ?"
        );

        $update->execute([
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
            $forma_pago,
            $activo,
            $id
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

            <h1 class="h3 mb-4 text-gray-800">Editar cliente</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php endif; ?>

            <form method="post" class="card shadow p-4">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control"
                               value="<?= $cliente['nombre'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Primer apellido *</label>
                        <input type="text" name="apellido1" class="form-control"
                               value="<?= $cliente['apellido1'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Segundo apellido</label>
                        <input type="text" name="apellido2" class="form-control"
                               value="<?= $cliente['apellido2'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= $cliente['email'] ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Documento</label>
                        <input type="text" name="documento" class="form-control"
                               value="<?= $cliente['documento'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control"
                               value="<?= $cliente['fecha_nacimiento'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control"
                               value="<?= $cliente['telefono'] ?>">
                    </div>

                    <div class="form-group col-md-8">
                        <label>Dirección</label>
                        <input type="text" name="direccion" class="form-control"
                               value="<?= $cliente['direccion'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>CP</label>
                        <input type="text" name="cp" class="form-control"
                               value="<?= $cliente['cp'] ?>">
                    </div>

                    <div class="form-group col-md-5">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" class="form-control"
                               value="<?= $cliente['ciudad'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>País</label>
                        <input type="text" name="pais" class="form-control"
                               value="<?= $cliente['pais'] ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Crédito</label>
                        <input type="number" step="0.01" name="credito" class="form-control"
                               value="<?= $cliente['credito'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Forma de pago</label>
                        <select name="forma_pago" class="form-control">
                            <option <?= $cliente['forma_pago'] === 'Transferencia' ? 'selected' : '' ?>>Transferencia</option>
                            <option <?= $cliente['forma_pago'] === 'Tarjeta' ? 'selected' : '' ?>>Tarjeta</option>
                            <option <?= $cliente['forma_pago'] === 'Efectivo' ? 'selected' : '' ?>>Efectivo</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Estado</label>
                        <select name="activo" class="form-control">
                            <option value="1" <?= $cliente['activo'] ? 'selected' : '' ?>>Activo</option>
                            <option value="0" <?= !$cliente['activo'] ? 'selected' : '' ?>>Baja</option>
                        </select>
                    </div>
                </div>

                </div>

                <div class="container p-5">
                    <div class="row">
                        <div class="col-10 text-center">
                            <button type="submit" class="btn btn-primary">
                                Guardar cambios
                            </button>
                            <a href="/proyecto/clientes/index.php" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                        <div class="col-2 text-end">
                            <a href="/proyecto/clientes/eliminar.php?id=<?= $cliente['id'] ?>"
                                class="btn btn-danger"
                                onclick="return confirm('¿Seguro que deseas dar de baja este cliente?')">
                                Baja
                            </a>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>

    </div>
</div>


