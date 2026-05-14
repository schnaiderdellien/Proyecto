<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Usuarios</h1>

<div id="contenedor-boton-nuevo"></div>


<div class="card shadow mb-4">
    <div class="card-body">

        <input type="text"
               id="buscador"
               class="form-control mb-3"
               placeholder="Buscar usuario...">

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody id="tabla-usuarios"></tbody>

            </table>

        </div>

    </div>
</div>

</div>
</div>
</div>
</div>

<!-- MODAL NUEVO -->

    <div class="modal fade" id="modalUsuarioNuevo" tabindex="-1">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <form id= "formNuevoUsuario" method="POST" action="index.php?ctl=guardarUsuario">

                    <div class="modal-header">
                        <h5 class="modal-title">Nuevo Usuario</h5>
                    </div>

                    <div class="modal-body">

                        <p><b>Nombre:</b><input type="text"name="nombre"id="nuevo_nombre"class="form-control mb-2"placeholder="Nombre">
                        </p>
                        <p><b>Email:</b><input type="email"name="email"id="nuevo_email"class="form-control mb-2"placeholder="Email">
                        </p>
                        <p><b>Contraseña:</b><input type="password"name="password"id="nuevo_password"class="form-control mb-2"placeholder="Contraseña">
                        </p>
                        <hr>
                        <p><b>Rol:</b><select name="id_rol"id="nuevo_rol"class="form-control mb-2"></select>
                        </p>
                        <p><b>Estado:</b>
                            <select name="id_estado"id="nuevo_estado"class="form-control mb-2">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </p>

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
<!-- MODAL EDITAR -->

    <div class="modal fade" id="modalUsuarioEditar" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form  id="formEditarUsuario" method="POST" action="index.php?ctl=editarUsuario">

                    <input type="hidden"
                        name="id_usuario"
                        id="edit_id_usuario">

                    <div class="modal-header"><h5 class="modal-title">Editar usuario</h5></div>
                    
                    <div class="modal-body">
                        <input type="text"name="nombre"id="edit_nombre"class="form-control mb-2">
                        <input type="email"name="email"id="edit_email"class="form-control mb-2">
                        <select name="id_rol"id="edit_rol"class="form-control mb-2"></select>
                        <select name="id_estado"id="edit_id_estado"class="form-control mb-2">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div>

                    <div class="modal-footer">

                        <button type="submit"
                                class="btn btn-success">
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

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_private.php'; ?>