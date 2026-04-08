<?php ob_start(); ?>

<div id="wrapper">
<?php require __DIR__ . '/../partials/sidebar.php'; ?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php require __DIR__ . '/../partials/topbar.php'; ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Productos</h1>

    <!-- BOTÓN -->

    <?php if ($params['rol'] == 1 || $params['rol'] == 2): ?>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalProducto">
        Nuevo Producto
        </button>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SKU</th>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($params['productos'] as $producto): ?>
                    <tr>
                        <td><?= $producto['id_productos'] ?></td>
                        <td><?= htmlspecialchars($producto['sku']) ?></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['modelo']) ?></td>
                        <td><?= $producto['precio_venta'] ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td><?= $producto['id_estado'] ?></td>
                        <td>
                            <a href="#modalProductoVer" class="btn btn-info btn-sm " data-toggle="modal" data-target="#modalProductoVer"   data-id="<?= $producto['id_productos'] ?>"
                                data-sku="<?= htmlspecialchars($producto['sku']) ?>"
                                data-nombre="<?= htmlspecialchars($producto['nombre']) ?>"
                                data-desc-corta="<?= htmlspecialchars($producto['descripcion_corta']) ?>"
                                data-desc-larga="<?= htmlspecialchars($producto['descripcion_larga']) ?>"
                                data-modelo="<?= htmlspecialchars($producto['modelo']) ?>"
                                data-precio-coste="<?= $producto['precio_coste'] ?>"
                                data-precio-venta="<?= $producto['precio_venta'] ?>"
                                data-moneda="<?= $producto['moneda'] ?>"
                                data-stock="<?= $producto['stock'] ?>"
                                data-stock-min="<?= $producto['stock_minimo'] ?>"
                                data-stock-max="<?= $producto['stock_maximo'] ?>"
                                data-estado="<?= $producto['id_estado'] ?>"
                                data-fecha-alta="<?= $producto['fecha_de_alta'] ?>"
                                data-fecha-baja="<?= $producto['fecha_de_baja'] ?>"
                                >
                            <i class="fas fa-eye"></i>
                            </a>
                            <?php if ($params['rol'] == 1 || $params['rol'] == 2): ?>
                                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="modalProducto" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="index.php?ctl=guardarProducto">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Producto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="sku" class="form-control mb-2" placeholder="SKU" required>
                        <input type="text" name="nombre" class="form-control mb-2" placeholder="Nombre" required>
                        <input type="text" name="modelo" class="form-control mb-2" placeholder="Modelo">
                        <input type="number" name="precio_coste" class="form-control mb-2" placeholder="Precio coste">
                        <input type="number" name="precio_venta" class="form-control mb-2" placeholder="Precio venta">
                        <input type="number" name="stock" class="form-control mb-2" placeholder="Stock">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL VER -->
    <div class="modal fade" id="modalProductoVer" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Ficha del Producto</h5>
                </div>

                <div class="modal-body">

                    <p><b>ID:</b> <span id="ver_id"></span></p>
                    <p><b>SKU:</b> <span id="ver_sku"></span></p>
                    <p><b>Nombre:</b> <span id="ver_nombre"></span></p>
                    <p><b>Descripción corta:</b> <span id="ver_desc_corta"></span></p>
                    <p><b>Descripción larga:</b> <span id="ver_desc_larga"></span></p>
                    <p><b>Modelo:</b> <span id="ver_modelo"></span></p>

                    <hr>

                    <p><b>Precio coste:</b> <span id="ver_precio_coste"></span></p>
                    <p><b>Precio venta:</b> <span id="ver_precio_venta"></span></p>
                    <p><b>Moneda:</b> <span id="ver_moneda"></span></p>

                    <hr>

                    <p><b>Stock:</b> <span id="ver_stock"></span></p>
                    <p><b>Stock mínimo:</b> <span id="ver_stock_min"></span></p>
                    <p><b>Stock máximo:</b> <span id="ver_stock_max"></span></p>

                    <hr>

                    <p><b>Estado:</b> <span id="ver_estado"></span></p>
                    <p><b>Fecha alta:</b> <span id="ver_fecha_alta"></span></p>
                    <p><b>Fecha baja:</b> <span id="ver_fecha_baja"></span></p>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>

            </div>
        </div>
    </div>

</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_private.php'; ?>