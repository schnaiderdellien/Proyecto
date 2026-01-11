<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$errores = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recoger datos
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

    // Insertar si no hay errores
    if (empty($errores)) {

        try {
            $stmt = $pdo->prepare(
                "INSERT INTO productos
                (codigo, nombre, descripcion_corta, tipo, categoria, subcategoria, marca, modelo,
                 precio_coste, precio_venta, stock, stock_min, stock_max)
                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)"
            );

            $stmt->execute([
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
                $stock_max
            ]);

            $success = true;

        } catch (PDOException $e) {
            $errores[] = 'Error al guardar el producto. El código puede estar duplicado.';
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

            <h1 class="h3 mb-4 text-gray-800">Nuevo producto / servicio</h1>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    Producto creado correctamente.
                    <a href="/proyecto/productos/index.php" class="alert-link">Volver al listado</a>
                </div>
            <?php endif; ?>

            <?php foreach ($errores as $error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>

            <form method="post" class="card shadow p-4">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Código *</label>
                        <input type="text" name="codigo" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nombre *</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tipo *</label>
                        <select name="tipo" class="form-control" id="tipo" required>
                            <option value="">Seleccione</option>
                            <option value="producto">Producto</option>
                            <option value="servicio">Servicio</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Categoría</label>
                        <input type="text" name="categoria" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Subcategoría</label>
                        <input type="text" name="subcategoria" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <input type="text" name="marca" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Modelo</label>
                        <input type="text" name="modelo" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio coste</label>
                        <input type="number" step="0.01" name="precio_coste" class="form-control">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio venta *</label>
                        <input type="number" step="0.01" name="precio_venta" class="form-control" required>
                    </div>
                </div>

                <!-- STOCK -->
                <div id="stock-fields">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock mínimo</label>
                            <input type="number" name="stock_min" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock máximo</label>
                            <input type="number" name="stock_max" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/proyecto/productos/index.php" class="btn btn-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>

<!-- JS PARA OCULTAR STOCK EN SERVICIOS -->
<script>
document.getElementById('tipo').addEventListener('change', function () {
    const stock = document.getElementById('stock-fields');
    if (this.value === 'servicio') {
        stock.style.display = 'none';
    } else {
        stock.style.display = 'block';
    }
});
</script>
