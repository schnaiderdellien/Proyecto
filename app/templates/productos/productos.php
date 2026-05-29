<?php ob_start(); ?>

<div id="wrapper">
<?php require __DIR__ . '/../partials/sidebar.php'; ?>
<div id="content-wrapper" class="d-flex flex-column">
<div id="content">
<?php require __DIR__ . '/../partials/topbar.php'; ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Productos</h1>

    <div id="contenedor-boton-nuevo"></div>

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
                        <option value="2">Inactivo</option>
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
    <div class="modal fade" id="modalProductoNuevo" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form id="formNuevoProducto" method="POST" action="index.php?ctl=guardarProducto">

                    <div class="modal-header"><h5 class="modal-title">Nuevo Producto</h5></div>
                    <div class="modal-body">
                        <p><b>SKU:</b><input type="text"name="sku" id="nuevo_sku"class="form-control mb-2"placeholder="SKU"></p>
                        <p><b>Nombre:</b><input type="text" name="nombre"id="nuevo_nombre"class="form-control mb-2"placeholder="Nombre"></p>
                        <p><b>Descripción corta:</b><input type="text" name="descripcion_corta"id="nuevo_desc_corta"class="form-control mb-2"placeholder="Descripción corta"></p>
                        <p><b>Descripción larga:</b><textarea name="descripcion_larga"id="nuevo_desc_larga"class="form-control mb-2" placeholder="Descripción larga"></textarea></p>
                        <hr>
                        <p><b>Modelo:</b><input type="text"name="modelo" id="nuevo_modelo"class="form-control mb-2"placeholder="Modelo"></p>
                        <p><b>Precio coste:</b><input type="number"step="0.01"name="precio_coste"id="nuevo_precio_coste" class="form-control mb-2"placeholder="Precio coste"></p>
                        <p><b>Precio venta:</b><input type="number"step="0.01"name="precio_venta"id="nuevo_precio_venta"class="form-control mb-2"placeholder="Precio venta"></p>
                        <p><b>Moneda:</b><input type="text"name="moneda"id="nuevo_moneda"class="form-control mb-2" placeholder="Moneda"></p>
                        <hr>
                        <p><b>Stock:</b><input type="number"name="stock"id="nuevo_stock"class="form-control mb-2" placeholder="Stock"></p>
                        <p><b>Stock mínimo:</b><input type="number"name="stock_minimo"id="nuevo_stock_min"class="form-control mb-2"placeholder="Stock mínimo">
                        </p>
                        <p><b>Stock máximo:</b><input type="number"name="stock_maximo" id="nuevo_stock_max"class="form-control mb-2"placeholder="Stock máximo"> </p>
                        <hr>
                        <p><b>Estado:</b>
                        <select name="id_estado"id="nuevo_estado"class="form-control mb-2">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </p>
                        <p><b>Fecha alta:</b>
                        <input type="date"name="fecha_alta"id="nuevo_fecha_alta"class="form-control mb-2">
                        </p>
                        <p><b>Fecha baja:</b><p id="nuevo_fecha_baja"class="form-control mb-2">-</p></p>

                    </div>

                    <div class="modal-footer">

                        <button type="submit"class="btn btn-success">
                            Guardar
                        </button>

                        <button type="button"class="btn btn-secondary"data-dismiss="modal">
                            Cerrar
                        </button>

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

    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalProductoEditar" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form  id="formEditarProducto" method="POST" action="index.php?ctl=editarProducto">

                    <input type="hidden" name="id_productos"id="edit_id_hidden">

                    <div class="modal-header">
                        <h5 class="modal-title">Editar Producto</h5>
                    </div>

                    <div class="modal-body">

                        <p><b>ID:</b><span id="edit_id"></span></p>
                        <p><b>SKU:</b><input type="text" name="sku"id="edit_sku"class="form-control mb-2"></p>
                        <p><b>Nombre:</b><input type="text"name="nombre"id="edit_nombre" class="form-control mb-2"></p>
                        <p><b>Descripción corta:</b><input type="text"name="descripcion_corta" id="edit_desc_corta" class="form-control mb-2"></p>
                        <p><b>Descripción larga:</b><textarea name="descripcion_larga" id="edit_desc_larga" class="form-control mb-2"></textarea> </p>
                        <hr>
                        <p><b>Modelo:</b><input type="text" name="modelo" id="edit_modelo" class="form-control mb-2"></p>
                        <p><b>Precio coste:</b><input type="number"step="0.01"name="precio_coste"id="edit_precio_coste" class="form-control mb-2"></p>
                        <p><b>Precio venta:</b><input type="number"step="0.01" name="precio_venta"id="edit_precio_venta"class="form-control mb-2"></p>
                        <p><b>Moneda:</b><input type="text"name="moneda"id="edit_moneda"class="form-control mb-2"></p>
                        <hr><p><b>Stock:</b><input type="number"name="stock"id="edit_stock"class="form-control mb-2"></p>
                        <p><b>Stock mínimo:</b><input type="number" name="stock_minimo" id="edit_stock_min" class="form-control mb-2"></p>
                        <p><b>Stock máximo:</b><input type="number" name="stock_maximo" id="edit_stock_max" class="form-control mb-2"></p>
                        <hr>
                        <p><b>Estado:</b>
                            <select name="id_estado"id="edit_estado" class="form-control mb-2">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </p>
                        <p><b>Fecha alta:</b><input type="date"name="fecha_alta"id="edit_fecha_alta" class="form-control mb-2"></p>
                        <p><b>Fecha baja:</b> <input type="date"name="fecha_baja"id="edit_fecha_baja"class="form-control mb-2"readonly>

                    </div>

                    <div class="modal-footer">

                        <button type="submit"
                                class="btn btn-success">
                            Guardar
                        </button>

                        <button type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                            Cerrar
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
</div>
</div>
</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_private.php'; ?>