<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Cambiar contraseña</h1>

<div class="row justify-content-center">

    <div class="col-lg-6">

        <div class="card shadow mb-4">

            <div class="card-body">

                <form method="POST"
                      action="index.php?ctl=guardarPassword">

                    <p>
                        <b>Contraseña actual:</b>
                        <input type="password"
                               name="password_actual"
                               id="password_actual"
                               class="form-control mb-3"
                               placeholder="Contraseña actual">
                    </p>

                    <p>
                        <b>Nueva contraseña:</b>
                        <input type="password"
                               name="password_nueva"
                               id="password_nueva"
                               class="form-control mb-3"
                               placeholder="Nueva contraseña">
                    </p>

                    <p>
                        <b>Confirmar contraseña:</b>
                        <input type="password"
                               name="password_confirmar"
                               id="password_confirmar"
                               class="form-control mb-3"
                               placeholder="Confirmar contraseña">
                    </p>

                    <button type="submit"
                            class="btn btn-primary">
                        Guardar contraseña
                    </button>

                </form>

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