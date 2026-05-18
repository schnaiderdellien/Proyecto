<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

    <!-- CABECERA -->

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            Nuevo pedido <span id="titulo_numero_pedido"></span>

        </h1>

        <div>

            <!-- IMPRIMIR -->

            <button onclick="window.print()"
                    class="btn btn-secondary shadow-sm">

                <i class="fas fa-print fa-sm text-white-50"></i>

                Imprimir pedido

            </button>

            <button id="btnGuardarPedido"class="btn btn-success"> <i class="fas fa-save"></i>

                Guardar pedido

            </button>


            <!-- VOLVER -->

            <a href="index.php?ctl=pedidos"
               class="btn btn-primary shadow-sm">

                <i class="fas fa-arrow-left fa-sm text-white-50"></i>

                Volver

            </a>

        </div>

    </div>

    <!-- INFORMACIÓN GENERAL -->

    <div class="row">

        <!-- PEDIDO -->

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Información del pedido

                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Número pedido</label>
                            <input type="text"id="numero_pedido" class="form-control"readonly>
                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Estado</label>

                            <select id="id_estado_pedido"
                                    class="form-control">
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Fecha pedido</label>

                            <input type="date" id="fecha_pedido"class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Comercial</label>

                            <select id="id_usuario"
                                    class="form-control">
                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- CLIENTE -->

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Cliente y facturación

                    </h6>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">

                            <label>Cliente</label>

                            <select id="id_cliente"
                                    class="form-control">
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Método de pago</label>

                            <select id="id_metodo_pago"
                                    class="form-control">
                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Impuesto</label>

                            <select id="id_impuesto"
                                    class="form-control">
                            </select>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- DETALLE -->

    <div class="card shadow mb-4">

        <div class="card-header py-3 d-flex justify-content-between align-items-center">

            <h6 class="m-0 font-weight-bold text-primary">

                Detalle del pedido

            </h6>

            <button class="btn btn-success btn-sm"
                    id="btnAgregarLinea">

                <i class="fas fa-plus"></i>

                Añadir línea

            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>SKU</th>

                            <th>Producto</th>

                            <th>Cantidad</th>

                            <th>Servido</th>

                            <th>Precio</th>

                            <th>Descuento</th>

                            <th>Total</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody id="tabla-detalle"></tbody>

                </table>

                <datalist id="lista-skus"></datalist>

                <datalist id="lista-productos"></datalist>

            </div>

        </div>

    </div>

    <!-- TOTALES -->

    <div class="row">

        <div class="col-lg-4 ml-auto">

            <div class="card shadow mb-4">

                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">

                        Totales

                    </h6>

                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-2">

                        <span>Bruto:</span>

                        <strong id="bruto">0.00 €</strong>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Descuento:</span>

                        <strong id="descuento"></strong>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>IVA:</span>

                        <strong id="iva_impuesto"></strong>

                    </div>

                    <div class="d-flex justify-content-between mb-2">

                        <span>Total:</span>

                        <strong id="total"></strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- NOTAS -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Notas

            </h6>

        </div>

        <div class="card-body">

            <textarea id="notas"
                      class="form-control"
                      rows="4"></textarea>

        </div>

    </div>

</div>

</div>

</div>

</div>

<?php $contenido = ob_get_clean(); ?>

<?php require __DIR__ . '/../layout_private.php'; ?>