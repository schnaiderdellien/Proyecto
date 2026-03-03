<?php ob_start(); ?>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-5 col-lg-6 col-md-8">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <div class="p-5">

                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">
                                CRM DAW
                            </h1>
                        </div>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="index.php?ctl=login" class="user">

                            <div class="form-group mb-3">
                                <input type="email"
                                       name="email"
                                       class="form-control form-control-user"
                                       placeholder="Correo electrónico"
                                       required>
                            </div>

                            <div class="form-group mb-3">
                                <input type="password"
                                       name="password"
                                       class="form-control form-control-user"
                                       placeholder="Contraseña"
                                       required>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary btn-user btn-block w-100">
                                Iniciar sesión
                            </button>

                        </form>

                        <hr>

                        <div class="text-center">
                            <a class="small" href="index.php?ctl=inicio">
                                Volver al inicio
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/layout_public.php'; ?>
