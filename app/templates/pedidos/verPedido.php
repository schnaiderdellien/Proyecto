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

            Pedido <span id="titulo_numero_pedido"></span>

        </h1>

        <div>

            <!-- IMPRIMIR -->

            <button onclick="window.print()"
                    class="btn btn-secondary shadow-sm">

                <i class="fas fa-print fa-sm text-white-50"></i>

                Imprimir pedido

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

                            <div id="numero_pedido"
                                 class="form-control bg-light"></div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Estado</label>

                            <div id="estado_pedido"
                                 class="form-control bg-light"></div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Fecha pedido</label>

                            <div id="fecha_pedido"
                                 class="form-control bg-light"></div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Comercial</label>

                            <div id="comercial"
                                 class="form-control bg-light"></div>

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

                            <div id="cliente"
                                 class="form-control bg-light"></div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Método de pago</label>

                            <div id="metodo_pago"
                                 class="form-control bg-light"></div>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Impuesto</label>

                            <div id="impuesto"
                                 class="form-control bg-light"></div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- DETALLE -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">

                Detalle del pedido

            </h6>

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

                        </tr>

                    </thead>

                    <tbody id="tabla-detalle"></tbody>

                </table>

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

                        <strong id="bruto"></strong>

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

            <div id="notas"
                 class="form-control bg-light"
                 style="min-height: 120px;"></div>

        </div>

    </div>

</div>

</div>

</div>

</div>

<?php $contenido = ob_get_clean(); ?>

<?php require __DIR__ . '/../layout_private.php'; ?>