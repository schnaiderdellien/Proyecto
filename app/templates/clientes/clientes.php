<?php ob_start(); ?>

<div id="wrapper">

<?php require __DIR__ . '/../partials/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<div id="content">

<?php require __DIR__ . '/../partials/topbar.php'; ?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Clientes</h1>

<div class="card shadow mb-4">
    <div class="card-body">

        <input type="text" id="buscador" class="form-control mb-3" placeholder="Buscar cliente...">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th class="w-auto text-nowrap">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla-clientes">

                </tbody>
            </table>
        </div>

    </div>
</div>

</div>
</div>
</div>
</div>

<?php $contenido = ob_get_clean(); ?>
<?php require __DIR__ . '/../layout_private.php'; ?>