<?php ob_start(); ?>

<div class="container-fluid">

    <div class="row justify-content-center mt-5">

        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card shadow-lg border-0">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <h1 class="h4 text-gray-900 mb-3">
                            ¿Has olvidado tu contraseña?
                        </h1>

                        <p class="text-muted">
                            Por motivos de seguridad, el restablecimiento de contraseña
                            debe ser gestionado por el administrador del sistema.
                        </p>

                    </div>

                    <div class="alert alert-info bg-dark border-0">

                        <p class="mb-2">
                            <i class="fas fa-envelope"></i>
                            Ponte en contacto con el administrador mediante correo electrónico:
                        </p>

                        <p class="mb-0 font-weight-bold">
                            <a href="mailto:admin@empresa.com">
                                admin@empresa.com
                            </a>
                        </p>

                    </div>

                    <div class="alert alert-warning  bg-dark border-0 mt-4">

                        <small>
                            Una vez recibas una contraseña temporal, deberás cambiarla
                            al acceder al sistema.
                        </small>

                    </div>

                    <div class="text-center mt-4">

                        <a href="index.php?ctl=inicio" class="btn btn-primary">
                            Volver al inicio
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_public.php'; ?>