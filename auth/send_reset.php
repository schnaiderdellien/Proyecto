<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/vendor/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/vendor/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/vendor/PHPMailer/src/SMTP.php';

$email = $_POST['email'] ?? '';

$mensaje = "Si el correo está registrado, recibirás un email con instrucciones.";

if ($email) {

    // Lógica para saber si el correo existe.
    $stmt = $pdo->prepare("SELECT id, email FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {

        //  token seguro
        $token = bin2hex(random_bytes(32));

        // Fecha de expiración
        $expira = date('Y-m-d H:i:s', strtotime('+3 minute'));

        // Guardar 
        $update = $pdo->prepare(
            "UPDATE usuarios 
             SET reset_token = ?, reset_expira = ? 
             WHERE id = ?"
        );
        $update->execute([$token, $expira, $usuario['id']]);

        $mail = new PHPMailer(true);
    
        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'schnaiderdellienasir@gmail.com';
            $mail->Password   = 'debcadjzhjmuejws';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
        
            // Emisor y receptor
            $mail->setFrom('schnaiderdellien@gmail.com', 'PROYECTO CRM');
            $mail->addAddress($email);
        
            // Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body    =
                "<p>Has solicitado restablecer tu contraseña.</p>
                <p>Haz clic en el siguiente enlace:</p>
                <p>
                    <a href='http://localhost/proyecto/auth/reset_password.php?token=$token'>
                        Restablecer contraseña
                    </a>
                </p>
                <p>Este enlace caduca en 3 minutos.</p>";
        
            $mail->send();
        
        } catch (Exception $e) {
            // No mostramos errores por seguridad
        }
    }

   
}
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="alert alert-info text-center">
                <?= $mensaje ?>
            </div>

            <div class="text-center">
                <a href="/proyecto/auth/login.php">Volver al login</a>
            </div>

        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/footer.php'; ?>
