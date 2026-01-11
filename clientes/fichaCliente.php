<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;

if(!$id){
    header('Location: /proyecto/clientes/index.php');
    exit;
}

$stmt =$pdo->prepare("SELECT * FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$cliente){
    header('Location: /proyecto/clientes/index.php');
    exit;
}

?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/sidebar.php'; ?>

<div id = "content-wrapper" class="d-flex flex-column">
    <div id = "content" class="flex-grow-1">

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/topbar.php'; ?>
    
        <div class = "container-fluid">

            <h1 class = "h3 mb-4 text-gray-800" >Cliente: <?= $cliente['nombre'] . " " . $cliente['apellido1'] . " " . $cliente['apellido2']?> </h1>

            <form  class= "card shadow p-4">

                <div class = "form-row">
                    <div class = "form-group col-md-4">
                        <p> Nombre:  </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['nombre']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Apellido: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['apellido1']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Apellido 2: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['apellido2']) ?></p>
                    </div>
                </div>

                
                <div class = "form-row">
                    <div class = "form-group col-md-4">
                        <p> Email:</p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['email']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Documento: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['documento']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Fecha nacimiento: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['fecha_nacimiento']) ?></p>
                    </div>
                </div>

                <div class = "form-row">
                    <div class = "form-group col-md-4">
                        <p> Teléfono:</p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['telefono']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-8">
                        <p> Dirección: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['direccion']) ?></p>
                    </div>
                </div>

                <div class = "form-row">
                    <div class = "form-group col-md-3">
                        <p> CP:</p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['cp']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-5">
                        <p> Ciudad: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['ciudad']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> País: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['pais']) ?></p>
                    </div>
                </div>

                <div class = "form-row">
                    <div class = "form-group col-md-4">
                        <p> Crédito:</p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['credito']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Forma de pago: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['forma_pago']) ?></p>
                    </div>
                    
                    <div class = "form-group col-md-4">
                        <p> Estado: </p>
                        <?php if ($cliente['activo']): ?>
                            <p class="form-control">Activo</p>
                        <?php else: ?>
                            <p class="form-control">Baja</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class= "form-row ">

                    <div class = "form-group col-md-6">
                        <p> Fecha de alta: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['fecha_alta']) ?></p>
                    </div>
                    <div class = "form-group col-md-6">
                        <p> Fecha de baja: </p>
                        <p class = "form-control"><?= htmlspecialchars($cliente['fecha_baja']) ?></p>
                    </div>

                </div>               

                <div class= "container text-center">
                    <a class= "btn btn-secondary "href="/proyecto/clientes/index.php">Volver a clientes</a>
                    <a href="/proyecto/clientes/editar.php?id=<?= $cliente['id'] ?>"class="btn btn-warning">Editar</a>
                </div>
                
    
            </form>
        </div>
        
    </div>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
</div>
            
