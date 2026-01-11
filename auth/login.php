<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';
?>
<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'] ??'';
    $password = $_POST['password'] ??'';

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ? ");
    $stmt->execute([$email]);

    $usuario =$stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])){
        $_SESSION['usuario']= $usuario['email'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];
        
        $update = $pdo->prepare(
            "UPDATE usuarios SET ultimo_login = NOW() WHERE id = ?"
        );
        $update->execute([$usuario['id']]);
        header ('Location: /proyecto/index.php');
        exit;
    }else{
        $error = "Usuario o contraseñas incorrectas";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="/proyecto/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/proyecto/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <!-- <img  class="img-thumbnail" src="https://cdn.pixabay.com/photo/2024/02/21/08/44/run-8587089_1280.png" alt="">-->
                            </div>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">CRM Dellien</h1>
                                    </div>

                                    <!-- Si la contraseña o el usuario es incorrecto -->
                                    <?php 
                                    if(isset($error)):
                                    ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>
                                    <!-- Si la contraseña o el usuario es incorrecto fin -->

                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" placeholder="Password"required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recuerdame la contraseña</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                        <hr>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                    <a class="small" href="/proyecto/auth/forgot_password.php">
                                        ¿Has olvidado tu contraseña?
                                    </a>
                                    </div>
                                    <!--<div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/proyecto/vendor/jquery/jquery.min.js"></script>
    <script src="/proyecto/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/proyecto/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/proyecto/js/sb-admin-2.min.js"></script>

</body>

</html>