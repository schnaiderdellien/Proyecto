<?php
session_start();

$_SESSION = [];

// Destruir la sesión
session_destroy();

header('Location: /proyecto/auth/login.php');
exit;