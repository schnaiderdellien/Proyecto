<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Pedidos
    </h1>

    <!-- BOTÓN NUEVO -->

    <div id="contenedor-boton-nuevo"></div>

    <!-- TARJETA -->

    <div class="card shadow mb-4">

        <div class="card-body">

            <!-- FILTROS -->

            <div class="row mb-3">

                <!-- BUSCADOR -->

                <div class="col-md-4 mb-2">

                    <input type="text"
                           id="buscador"
                           class="form-control"
                           placeholder="Buscar pedido...">

                </div>

                <!-- FILTRO COMERCIAL -->

                <div class="col-md-4 mb-2">

                    <select id="buscadorComercial"
                            class="form-control">

                        <option value="">
                            Todos los comerciales
                        </option>

                    </select>

                </div>

                <!-- FILTRO ESTADO -->

                <div class="col-md-4 mb-2">

                    <select id="filtroEstado"
                            class="form-control">

                        <option value="">
                            Todos los estados
                        </option>

                    </select>

                </div>

            </div>

            <!-- TABLA -->

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th data-campo="numero_pedido">
                                Número
                            </th>

                            <th data-campo="nombreCliente">
                                Cliente
                            </th>

                            <th data-campo="comercial">
                                Comercial
                            </th>

                            <th data-campo="estado">
                                Estado
                            </th>

                            <th data-campo="fecha_pedido">
                                Fecha
                            </th>

                            <th data-campo="total">
                                Total
                            </th>

                            <th>
                                Acciones
                            </th>

                        </tr>

                    </thead>

                    <tbody id="tabla-pedidos"></tbody>

                </table>

            </div>

            <!-- PAGINADOR -->

            <nav>

                <ul class="pagination justify-content-center"
                    id="paginador">

                </ul>

            </nav>

        </div>

    </div>

</div>
</div>
</div>
</div>

<!-- MODAL VER PEDIDO -->

<div class="modal fade"
     id="modalVerPedido"
     tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Información del pedido
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Número:</b>
                            <span id="ver_numero"></span>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Cliente:</b>
                            <span id="ver_cliente"></span>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Comercial:</b>
                            <span id="ver_comercial"></span>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Estado:</b>
                            <span id="ver_estado"></span>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Fecha:</b>
                            <span id="ver_fecha"></span>
                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <p>
                            <b>Total:</b>
                            <span id="ver_total"></span>
                        </p>

                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                    Cerrar

                </button>

            </div>

        </div>

    </div>

</div>

<?php $contenido = ob_get_clean(); ?>

<?php require __DIR__ . '/../layout_private.php'; ?>