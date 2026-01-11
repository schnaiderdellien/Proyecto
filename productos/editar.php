<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;
$errores = [];
$success = false;

// Si no hay ID → volver
if (!$id) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

// Obtener producto
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

// Si no existe → volver
if (!$producto) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $codigo = trim($_POST['codigo'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $tipo = $_POST['tipo'] ?? '';
    $categoria = trim($_POST['categoria'] ?? '');
    $subcategoria = trim($_POST['subcategoria'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $precio_coste = $_POST['precio_coste'] ?? 0;
    $precio_venta = $_POST['precio_venta'] ?? 0;
    $stock = $_POST['stock'] ?? null;
    $stock_min = $_POST['stock_min'] ?? null;
    $stock_max = $_POST['stock_max'] ?? null;
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Validaciones mínimas
    if ($codigo === '' || $nombre === '' || $tipo === '' || $precio_venta <= 0) {
        $errores[] = 'Los campos Código, Nombre, Tipo y Precio de venta son obligatorios.';
    }

    // Si es servicio, anulamos stock
    if ($tipo === 'servicio') {
        $stock = null;
        $stock_min = null;
        $stock_max = null;
        $precio_coste = 0;
    }

    // Actualizar
    if (empty($errores)) {
        try {
            $update = $pdo->prepare(
                "UPDATE productos SET
                    codigo = ?,
                    nombre = ?,
                    descripcion_corta = ?,
                    tipo = ?,
                    categoria = ?,
                    subcategoria = ?,
                    marca = ?,
                    modelo = ?,
                    precio_coste = ?,
                    precio_venta = ?,
                    stock = ?,
                    stock_min = ?,
                    stock_max = ?
                 WHERE id = ?"
            );

            $update->execute([
                $codigo,
                $nombre,
                $descripcion,
                $tipo,
                $categoria,
                $subcategoria,
                $marca,
                $modelo,
                $precio_coste,
                $precio_venta,
                $stock,
                $stock_min,
                $stock_max,
                $id
            ]);

            $success = true;

            // Recargar datos actualizados
            $stmt->execute([$id]);
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            $errores[] = 'Error al actualizar el producto. El código puede estar duplicado.';
        }
    }
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content" class="flex-grow-1">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">
                Editar producto / servicio
            </h1>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    Cambios guardados correctamente.
                    <a href="/proyecto/productos/index.php" class="alert-link">
                        Volver al listado
                    </a>
                </div>
            <?php endif; ?>

            <?php foreach ($errores as $error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>

            <form method="post" class="card shadow p-4">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Código *</label>
                        <input type="text" name="codigo" class="form-control"
                               value="<?= htmlspecialchars($producto['codigo']) ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control"
                               value="<?= htmlspecialchars($producto['nombre']) ?>" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tipo *</label>
                        <select name="tipo" class="form-control" id="tipo" required>
                            <option value="producto" <?= $producto['tipo'] === 'producto' ? 'selected' : '' ?>>
                                Producto
                            </option>
                            <option value="servicio" <?= $producto['tipo'] === 'servicio' ? 'selected' : '' ?>>
                                Servicio
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Categoría</label>
                        <input type="text" name="categoria" class="form-control"
                               value="<?= htmlspecialchars($producto['categoria']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Subcategoría</label>
                        <input type="text" name="subcategoria" class="form-control"
                               value="<?= htmlspecialchars($producto['subcategoria']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <input type="text" name="marca" class="form-control"
                               value="<?= htmlspecialchars($producto['marca']) ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Modelo</label>
                        <input type="text" name="modelo" class="form-control"
                               value="<?= htmlspecialchars($producto['modelo']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio coste</label>
                        <input type="number" step="0.01" name="precio_coste" class="form-control"
                               value="<?= $producto['precio_coste'] ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio venta *</label>
                        <input type="number" step="0.01" name="precio_venta" class="form-control"
                               value="<?= $producto['precio_venta'] ?>" required>
                    </div>
                </div>

                <!-- STOCK -->
                <div id="stock-fields">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control"
                                   value="<?= $producto['stock'] ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock mínimo</label>
                            <input type="number" name="stock_min" class="form-control"
                                   value="<?= $producto['stock_min'] ?>">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock máximo</label>
                            <input type="number" name="stock_max" class="form-control"
                                   value="<?= $producto['stock_max'] ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($producto['descripcion_corta']) ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/proyecto/productos/index.php" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Guardar cambios
                    </button>
                </div>

            </form>

        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>

<!-- JS: ocultar stock si es servicio -->
<script>
function toggleStock() {
    const tipo = document.getElementById('tipo').value;
    document.getElementById('stock-fields').style.display =
        (tipo === 'servicio') ? 'none' : 'block';
}

document.getElementById('tipo').addEventListener('change', toggleStock);
toggleStock();
</script>
