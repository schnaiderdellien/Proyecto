<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Clientes</h1>

<div id="contenedor-boton-nuevo"></div>

<div class="card shadow mb-4">
    <div class="card-body">

        <div class="row mb-3">

            
            <div class="col-md-4">
                <input type="text" id="buscador" class="form-control" placeholder="Buscar cliente...">
            </div>

            <div class="col-md-4">
                <input type="text" id="buscadorTel" class="form-control" placeholder="Buscar por teléfono">
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
                        <th data-campo="documento">Documento</th>
                        <th data-campo="nombre">Nombre</th>
                        <th data-campo="email">Email</th>
                        <th data-campo="telefono">Teléfono</th>
                        <th data-campo="id_estado">Estado</th>
                        <th class="w-auto text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-clientes">

                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-center" id="paginador"></ul>
        </nav>

    </div>
</div>
    <!-- MODAL NUEVO -->
    <div class="modal fade" id="modalClienteNuevo" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form id="formNuevoCliente" method="POST" action="index.php?ctl=guardarCliente">

                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Cliente</h5>
                    </div>

                <div class="modal-body">

                    <p><b>Nombre:</b><input type="text" name="nombre" id="nuevo_nombre"class="form-control mb-2" placeholder="Nombre"></p>
                    <p><b>Primer apellido:</b><input type="text" name="apellido1" id="nuevo_apellido1"class="form-control mb-2" placeholder="Primer apellido"> </p>
                    <p><b>Segundo apellido:</b><input type="text" name="apellido2" id="nuevo_apellido2"class="form-control mb-2" placeholder="Segundo apellido">
                    </p>
                    <hr>
                    <p><b>Documento:</b><input type="text" name="documento" id="nuevo_documento"class="form-control mb-2" placeholder="Documento"> </p>
                    <p><b>Email:</b><input type="text" name="email" id="nuevo_email"class="form-control mb-2" placeholder="Email"></p>
                    <p><b>Teléfono:</b><input type="text" name="telefono" id="nuevo_telefono"class="form-control mb-2" placeholder="Teléfono">
                    </p>
                    <p><b>Fecha nacimiento:</b><input type="date" name="fecha_nacimiento" id="nuevo_fecha_nacimiento" class="form-control mb-2"></p>
                    <hr>
                    <p><b>Dirección:</b><input type="text" name="direccion" id="nuevo_direccion" class="form-control mb-2" placeholder="Dirección"></p>
                    <p><b>CP:</b><input type="text" name="cp" id="nuevo_cp"class="form-control mb-2" placeholder="CP"></p>
                    <p><b>Ciudad:</b><input type="text" name="ciudad" id="nuevo_ciudad"class="form-control mb-2" placeholder="Ciudad"> </p>
                    <p><b>País:</b><input type="text" name="pais" id="nuevo_pais"class="form-control mb-2" placeholder="País"></p>
                    <hr>
                    <p><b>Método de pago:</b><select name="id_metodo_pago" id="nuevo_metodo_pago"class="form-control mb-2"></select></p>
                    <p><b>Impuesto:</b><select name="id_impuesto" id="nuevo_impuesto"class="form-control mb-2"></select> </p>
                    <p><b>Crédito:</b><input type="text" name="credito" id="nuevo_credito"class="form-control mb-2" placeholder="Crédito"></p>
                    <hr>
                    <p><b>Estado:</b>
                        <select name="id_estado" id="nuevo_estado"
                            class="form-control mb-2">
                            <option value="1">Activo</option>
                        </select>
                    </p>
                    <p><b>Fecha alta:</b><input type="date" name="fecha_alta" id="nuevo_fecha_alta" class="form-control mb-2"></p>
                    <p><b>Fecha baja:</b><p type="text" name="fecha_baja" id="nuevo_fecha_baja"class="form-control mb-2">-</p></p>
                    <p><b>Comercial:</b><select name="id_usuario" id="nuevo_usuario"class="form-control mb-2"></select></p>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>

                </form>

            </div>

        </div>
    </div>

    <!-- MODAL VER -->
    <div class="modal fade" id="modalClienteVer" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ficha del Cliente</h5>
                </div>
                <div class="modal-body">
                    <p><b>ID:</b> <span id="ver_id"></span></p>
                    <p><b>Nombre:</b> <span id="ver_nombre"></span></p>
                    <p><b>Apellido 1:</b> <span id="ver_apellido1"></span></p>
                    <p><b>Apellido 2:</b> <span id="ver_apellido2"></span></p>
                    <hr>
                    <p><b>Documento:</b> <span id="ver_documento"></span></p>
                    <p><b>Email:</b> <span id="ver_email"></span></p>
                    <p><b>Teléfono:</b> <span id="ver_telefono"></span></p>
                    <p><b>Fecha nacimiento:</b> <span id="ver_fecha_nacimiento"></span></p>
                    <hr>
                    <p><b>Dirección:</b> <span id="ver_direccion"></span></p>
                    <p><b>CP:</b> <span id="ver_cp"></span></p>
                    <p><b>Ciudad:</b> <span id="ver_ciudad"></span></p>
                    <p><b>País:</b> <span id="ver_pais"></span></p>
                    <hr>
                    <p><b>Método de pago:</b> <span id="ver_metodo_pago"></span></p>
                    <p><b>Impuesto:</b> <span id="ver_impuesto"></span></p>
                    <p><b>Crédito:</b> <span id="ver_credito"></span></p>
                    <hr>
                    <p><b>Estado:</b> <span id="ver_estado"></span></p>
                    <p><b>Fecha alta:</b> <span id="ver_fecha_alta"></span></p>
                    <p><b>Fecha baja:</b> <span id="ver_fecha_baja"></span></p>
                    <p><b>Comercial:</b> <span id="ver_usuario"></span></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalClienteEditar" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form  id="formEditarCliente" method="POST" action="index.php?ctl=editarCliente">
                    <input type="hidden" name="id_cliente" id="edit_id_hidden">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Cliente</h5>
                    </div>
                    <div class="modal-body">
                        <p><b>ID: </b><span  id="edit_id"></span></p>
                        <p><b>Nombre:</b><input type="text" name="nombre" id="edit_nombre" class="form-control mb-2" placeholder="Nombre"></p>
                        <p><b>Primer apellido:</b><input type="text" name="apellido1" id="edit_apellido1" class="form-control mb-2" placeholder="Primer apellido"></p>
                        <p><b>Segundo apellido:</b><input type="text" name="apellido2" id="edit_apellido2" class="form-control mb-2" placeholder="Segundo apellido"></p>
                        <hr>
                        <p><b>Documento:</b><input type="text" name="documento" id="edit_documento" class="form-control mb-2" placeholder="Documento"></p>
                        <p><b>Email:</b><input type="text" name="email" id="edit_email" class="form-control mb-2" placeholder="Email"></p>
                        <p><b>Teléfono:</b><input type="text" name="telefono" id="edit_telefono" class="form-control mb-2" placeholder="Teléfono"></p>
                        <p><b>Fecha nacimiento:</b><input type="text" name="fecha_nacimiento" id="edit_fecha_nacimiento" class="form-control mb-2" placeholder="Fecha de naciemiento"></p>
                        <hr>
                        <p><b>Dirección:</b><input type="text" name="direccion" id="edit_direccion" class="form-control mb-2" placeholder="Dirección"></p>
                        <p><b>CP:</b><input type="text" name="cp" id="edit_cp" class="form-control mb-2" placeholder="CP"></p>
                        <p><b>Ciudad:</b><input type="text" name="ciudad" id="edit_ciudad" class="form-control mb-2" placeholder="Ciudad"></p>
                        <p><b>País:</b><input type="text" name="pais" id="edit_pais" class="form-control mb-2" placeholder="País"></p>
                        <hr>
                        <p><b>Método de pago:</b><select name="id_metodo_pago" id="edit_metodo_pago" class="form-control mb-2"></select></p>
                        <p><b>Impuesto:</b><select name="id_impuesto" id="edit_impuesto" class="form-control mb-2"></select></p>
                        <p><b>Crédito:</b><input type="text" name="credito" id="edit_credito" class="form-control mb-2" placeholder="Crédito"></p>
                        <hr>
                        <p><b>Estado:</b><select name="id_estado" id="edit_estado" class="form-control mb-2"><option value="1">Activo</option><option value="2">Inactivo</option></select></p>
                        <p><b>Fecha alta:</b><input type="text" name="fecha_alta" id="edit_fecha_alta" class="form-control mb-2" placeholder="Fecha alta"></p>
                        <p><b>Fecha baja:</b></p><input type="date" name="fecha_baja"id="edit_fecha_baja"class="form-control mb-2"readonly>
                        <p><b>Comercial:</b><select name="id_usuario" id="edit_usuario" class="form-control mb-2"></select></p>
                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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