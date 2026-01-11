<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';


// Registros por página (20 por defecto)
$por_pagina = $_GET['limit'] ?? 20;
$pagina = $_GET['page'] ?? 1;

$por_pagina = (int)$por_pagina;
$pagina = (int)$pagina;

if ($por_pagina <= 0) $por_pagina = 20;
if ($pagina <= 0) $pagina = 1;

$offset = ($pagina - 1) * $por_pagina;

// Total de productos
$total = $pdo->query("SELECT COUNT(*) FROM productos")->fetchColumn();
$total_paginas = ceil($total / $por_pagina);


$stmt = $pdo->prepare(
    "SELECT id, codigo, nombre, tipo, categoria, precio_venta, stock, activo
     FROM productos
     ORDER BY nombre
     LIMIT :limit OFFSET :offset"
);

$stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

    <div id="content" class="flex-grow-1">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

        <div class="container-fluid">

            <!-- Título -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 text-gray-800">Productos y servicios</h1>
                <a href="/proyecto/productos/crear.php" class="btn btn-primary">
                    Nuevo producto / servicio
                </a>
            </div>

            <!-- Para saber cuantas páginas se muestran -->
            <form method="get" class="form-inline mb-3">
                <label class="mr-2">Mostrar</label>
                <select name="limit" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="20" <?= $por_pagina == 20 ? 'selected' : '' ?>>20</option>
                    <option value="30" <?= $por_pagina == 30 ? 'selected' : '' ?>>30</option>
                    <option value="50" <?= $por_pagina == 50 ? 'selected' : '' ?>>50</option>
                </select>
                <span>registros</span>
            </form>

            <!-- TABLA -->
            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if (count($productos) === 0): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No hay productos registrados
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['codigo']) ?></td>
                                <td><?= htmlspecialchars($p['nombre']) ?></td>
                                <td>
                                    <span class="badge badge-<?= $p['tipo'] === 'producto' ? 'info' : 'secondary' ?>">
                                        <?= ucfirst($p['tipo']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($p['categoria']) ?></td>
                                <td><?= number_format($p['precio_venta'], 2) ?> €</td>
                                <td class="text-center">
                                    <?php if ($p['tipo'] === 'producto'): ?>
                                        <?= (int)$p['stock'] ?>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($p['activo']): ?>
                                        <span class="badge badge-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Baja</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="/proyecto/productos/fichaProducto.php?id=<?= $p['id'] ?>"
                                       class="btn btn-sm btn-success">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>

            <!-- PAGINACIÓN -->
            <?php if ($total_paginas > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                                <a class="page-link"
                                   href="?page=<?= $i ?>&limit=<?= $por_pagina ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        </div>
    </div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>
