<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light topbar-custom mb-4 static-top shadow">

    <!-- Sidebar Toggle -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Usuario -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle"
               href="#"
               id="userDropdown"
               role="button"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?= htmlspecialchars($this->session->getUserName()) ?>
                </span>

                <span class="badge badge-secondary ml-2">
                    Nivel <?= $this->session->getUserLevel() ?>
                </span>

            </a>

            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                 aria-labelledby="userDropdown">

                <a class="dropdown-item" href="index.php?ctl=cambiarPassword">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cambiar contraseña
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="index.php?ctl=logout">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar sesión
                </a>

            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->