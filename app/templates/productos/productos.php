<?php ob_start(); ?>

<div id="wrapper">
<?php require __DIR__ . '/../partials/sidebar.php'; ?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php require __DIR__ . '/../partials/topbar.php'; ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Productos</h1>

    <?php /** @var array $params */ ?><!-- Para quitar el aviso del params -->

    <?php if ($params['rol'] == 1 || $params['rol'] == 2): ?>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalProducto">
            Nuevo Producto
        </button>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar producto">
                </div>
                <div class="col-md-4">
                    <input type="text" id="buscadorPrecio" class="form-control" placeholder="Buscar por precio">
                </div>
                <div class="col-md-3">
                    <select id="filtroEstado" class="form-control">
                        <option value="">Todos</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th data-campo="sku">SKU</th>
                            <th data-campo="nombre">Nombre</th>
                            <th data-campo="modelo">Modelo</th>
                            <th data-campo="precio_venta">Precio Venta</th>
                            <th data-campo="stock">Stock</th>
                            <th data-campo="id_estado">Estado</th>
                            <th class="w-auto text-nowrap">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-productos">
                    </tbody>
                </table>
            </div>

        <nav>
            <ul class="pagination justify-content-center" id="paginador"></ul>
        </nav>

        </div>
    </div>

    <!-- MODAL NUEVO -->
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
</div>
</div>
</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_private.php'; ?>