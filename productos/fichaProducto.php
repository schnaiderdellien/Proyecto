<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;
$errores = [];
$success = false;

if (!$id) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>


<div id="content-wrapper" class="d-flex flex-column">
    <div id="content" class="flex-grow-1">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

        <div class="container-fluid">

            <h1 class="h3 mb-4 text-gray-800">
                Ficha de producto
            </h1>

            <form method="post" class="card shadow p-4">

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Código *</label>
                        <p name="codigo" class="form-control"><?= htmlspecialchars($producto['codigo']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Nombre *</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['nombre']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Tipo *</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['tipo']) ?> </p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Categoría</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['categoria']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Subcategoría</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['subcategoria']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['marca']) ?> </p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Modelo</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['modelo']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio coste</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['precio_coste']) ?> </p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Precio venta *</label>
                        <p name="nombre" class="form-control"><?= htmlspecialchars($producto['precio_venta']) ?> </p>
                    </div>
                </div>

                <!-- STOCK -->
                <div id="stock-fields">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Stock</label>
                            <p name="nombre" class="form-control"><?= htmlspecialchars($producto['stock']) ?> </p>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock mínimo</label>
                            <p name="nombre" class="form-control"><?= htmlspecialchars($producto['stock_min']) ?> </p>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Stock máximo</label>
                            <p name="nombre" class="form-control"><?= htmlspecialchars($producto['stock_max']) ?> </p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <p name="nombre" class="form-control"><?= htmlspecialchars($producto['descripcion_corta']) ?> </p>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="/proyecto/productos/index.php" class="btn btn-secondary">
                        Volver a productos
                    </a>
                    <a href="/proyecto/productos/editar.php?id=<?=$producto['id'] ?>" class="btn btn-warning">
                        Editar
                    </a>
                    <a href="/proyecto/productos/eliminar.php?id=<?=$producto['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro que deseas dar de baja este cliente?')">
                        Baja
                    </a>
                </div>

            </form>

        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>