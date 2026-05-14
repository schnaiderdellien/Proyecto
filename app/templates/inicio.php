<?php  ob_start(); ?>

    <?php
    /*
    <div class="text-center">
        <h4 class="text-muted"><?= htmlspecialchars($params['fecha']) ?></h4>

        <h1 class="mt-3"><?= htmlspecialchars($params['mensaje']) ?></h1>

        <p class="lead mt-3">
            <?= htmlspecialchars($params['mensaje2']) ?>
        </p>

        <p> <?= htmlspecialchars($params['pass']??'')?> </p>

    </div>
    */
    ?>

    <?php
    /** @var string $contenido */
    /** @var array $params */
    ?> <!-- Para quitar el aviso del params -->

    <section class="bg-gradient-primary text-white py-5">

        <div class="container">

            <div class="row align-items-center min-vh-75">

                <div class="col-lg-6">

                    <div class="mb-3">

                        <span class="badge badge-light text-primary px-3 py-2 shadow-sm">

                            <?= htmlspecialchars($params['fecha']) ?>

                        </span>

                    </div>

                    <h1 class="display-3 font-weight-bold mb-4">

                        <?= htmlspecialchars($params['mensaje']) ?>

                    </h1>

                    <p class="lead mb-4 text-white-50">

                        <?= htmlspecialchars($params['mensaje2']) ?>

                    </p>

                    <div class="d-flex flex-wrap">

                        <!--<a href="index.php?ctl=login"
                        class="btn btn-light btn-lg shadow mr-3 mb-2">

                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Acceder

                        </a>-->

                        <a href="#features"
                        class="btn btn-outline-light btn-lg mb-2">

                            Ver funcionalidades

                        </a>

                    </div>

                </div>

                <!-- Logo -->
                <div class="col-lg-6 text-center">

                    <img src="/proyecto/web/assets/img/logoDellien.png"
                        alt="CRM"
                        class="img-fluid"
                        style="max-height: 350px;">

                </div>

            </div>

        </div>

    </section>

    <!-- FEATURES -->

    <section id="features" class="py-5 bg-light">

        <div class="container">

            <!-- Titulo funcionalidades -->

            <div class="text-center mb-5">

                <h2 class="font-weight-bold text-gray-900">

                    Funcionalidades principales

                </h2>

                <p class="text-muted lead">

                    Todo lo necesario para gestionar tu negocio

                </p>

            </div>

            <!-- Cliente -->

            <div class="row">

                <div class="col-lg-4 mb-4">

                    <div class="card border-0 shadow h-100">

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-users fa-4x text-primary"></i>

                            </div>

                            <h4 class="font-weight-bold">

                                Clientes

                            </h4>

                            <p class="text-muted">

                                Gestiona clientes, contactos, información fiscal
                                y seguimiento comercial.

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Productos -->

                <div class="col-lg-4 mb-4">

                    <div class="card border-0 shadow h-100">

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-box-open fa-4x text-success"></i>

                            </div>

                            <h4 class="font-weight-bold">

                                Productos

                            </h4>

                            <p class="text-muted">

                                Control de stock, precios, estados y catálogo
                                empresarial.

                            </p>

                        </div>

                    </div>

                </div>

                <!-- Dashboard -->
                <div class="col-lg-4 mb-4">

                    <div class="card border-0 shadow h-100">

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-chart-line fa-4x text-info"></i>

                            </div>

                            <h4 class="font-weight-bold">

                                Dashboard

                            </h4>

                            <p class="text-muted">

                                Visualiza estadísticas, métricas y resultados
                                en tiempo real.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- CARRUSEL -->

    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="font-weight-bold text-gray-900">

                    Plataforma empresarial moderna

                </h2>

            </div>

            <div id="carouselCRM"
                class="carousel slide shadow-lg"
                data-ride="carousel">

                <ol class="carousel-indicators">

                    <li data-target="#carouselCRM"
                        data-slide-to="0"
                        class="active"></li>

                    <li data-target="#carouselCRM"
                        data-slide-to="1"></li>

                    <li data-target="#carouselCRM"
                        data-slide-to="2"></li>

                </ol>

                <div class="carousel-inner rounded">

                    <div class="carousel-item active">

                        <img src="/proyecto/web/assets/img/slide1.jpg"
                            class="d-block w-100"
                            style="height: 500px; object-fit: cover;">

                        <div class="carousel-caption d-none d-md-block">

                            <h3 class="font-weight-bold">

                                Gestión eficiente

                            </h3>

                            <p>

                                Centraliza toda la información empresarial.

                            </p>

                        </div>

                    </div>

                    <div class="carousel-item">

                        <img src="/proyecto/web/assets/img/slide2.jpg"
                            class="d-block w-100"
                            style="height: 500px; object-fit: cover;">

                        <div class="carousel-caption d-none d-md-block">

                            <h3 class="font-weight-bold">

                                Control total

                            </h3>

                            <p>

                                Supervisa productos, usuarios y clientes.

                            </p>

                        </div>

                    </div>

                    <div class="carousel-item">

                        <img src="/proyecto/web/assets/img/slide3.jpg"
                            class="d-block w-100"
                            style="height: 500px; object-fit: cover;">

                        <div class="carousel-caption d-none d-md-block">

                            <h3 class="font-weight-bold">

                                Datos en tiempo real

                            </h3>

                            <p>

                                Obtén métricas y estadísticas avanzadas.

                            </p>

                        </div>

                    </div>

                </div>

                <a class="carousel-control-prev"
                href="#carouselCRM"
                role="button"
                data-slide="prev">

                    <span class="carousel-control-prev-icon"></span>

                </a>

                <a class="carousel-control-next"
                href="#carouselCRM"
                role="button"
                data-slide="next">

                    <span class="carousel-control-next-icon"></span>

                </a>

            </div>

        </div>

    </section>

    <!-- CTA -->

    <section class="py-5 bg-primary text-white">

        <div class="container text-center">

            <h2 class="display-4 font-weight-bold mb-4">

                Empieza a gestionar mejor tu empresa

            </h2>

            <p class="lead mb-4 text-white-50">

                Plataforma moderna, intuitiva y preparada para crecer contigo.

            </p>

        </div>

    </section>

    <!-- FOOTER -->

    <footer class="bg-dark text-white py-5">

        <div class="container">

            <div class="row">

                <div class="col-lg-4 mb-4">

                    <img src="/proyecto/web/assets/img/logoDellien.png"
                        alt="Logo"
                        style="max-width: 180px;">

                    <p class="text-white-50 mt-3">

                        CRM empresarial desarrollado para la gestión
                        moderna de clientes, productos y usuarios.

                    </p>

                </div>

                <div class="col-lg-4 mb-4">

                    <h5 class="font-weight-bold mb-4">

                        Navegación

                    </h5>

                    <ul class="list-unstyled">

                        <li class="mb-2">

                            <a href="index.php?ctl=inicio"
                            class="text-white-50">

                                Inicio

                            </a>

                        </li>

                        <li class="mb-2">

                            <a href="index.php?ctl=login"
                            class="text-white-50">

                                Acceso

                            </a>

                        </li>

                        <li>

                            <a href="index.php?ctl=olvidePassword"
                            class="text-white-50">

                                Soporte

                            </a>

                        </li>

                    </ul>

                </div>

                <div class="col-lg-4">

                    <h5 class="font-weight-bold mb-4">

                        Contacto

                    </h5>

                    <p class="text-white-50">

                        <i class="fas fa-envelope mr-2"></i>
                        admin@empresa.com

                    </p>

                    <p class="text-white-50">

                        <i class="fas fa-phone mr-2"></i>
                        +34 600 000 000

                    </p>

                </div>

            </div>

            <hr class="bg-secondary">

            <div class="text-center text-white-50">

                © <?= date('Y') ?> CRM DAW - Todos los derechos reservados

            </div>

        </div>

    </footer>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/layout_public.php'; ?> 