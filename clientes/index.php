<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$por_pagina = $_GET['limit'] ?? 20;
$pagina = $_GET['page'] ?? 1;

$por_pagina = (int)$por_pagina;
$pagina = (int)$pagina;

if ($por_pagina <= 0) $por_pagina = 20;
if ($pagina <= 0) $pagina = 1;

$offset = ($pagina - 1) * $por_pagina;


$total = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
$total_paginas = ceil($total / $por_pagina);


$stmt = $pdo->prepare(
    "SELECT *
     FROM clientes
     ORDER BY id DESC
     LIMIT :limit OFFSET :offset"
);

$stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php
include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php';
?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content" class="flex-grow-1">

        <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>

        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
                <a href="/proyecto/clientes/crear.php" class="btn btn-secondary btn-sm">
                    + Nuevo cliente
                </a>
            </div>

            <form method="get" class="form-inline mb-3">
                <label class="mr-2">Mostrar</label>
                <select name="limit" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="20" <?= $por_pagina == 20 ? 'selected' : '' ?>>20</option>
                    <option value="30" <?= $por_pagina == 30 ? 'selected' : '' ?>>30</option>
                    <option value="50" <?= $por_pagina == 50 ? 'selected' : '' ?>>50</option>
                </select>
                <span>registros</span>
            </form>

            <div class="card shadow mb-4">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Doc</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Ciudad</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td><?= htmlspecialchars($cliente['nombre']) . ' ' . htmlspecialchars($cliente['apellido1']) . ' ' . htmlspecialchars($cliente['apellido2']) ?></td>
                                    <td><?= htmlspecialchars($cliente['documento']) ?></td>
                                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                                    <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                                    <td><?= htmlspecialchars($cliente['ciudad']) ?></td>
                                    <td>
                                        <?php if ($cliente['activo']): ?>
                                            <span class="badge badge-success">Activo</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Baja</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/proyecto/clientes/fichaCliente.php?id=<?= $cliente['id'] ?>"
                                           class="btn btn-sm btn-success"
                                           >
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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

