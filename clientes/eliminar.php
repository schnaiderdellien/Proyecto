<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: /proyecto/clientes/index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    header('Location: /proyecto/clientes/index.php');
    exit;
}

$update = $pdo->prepare(
    "UPDATE clientes 
     SET activo = 0, fecha_baja = NOW()
     WHERE id = ?"
);
$update->execute([$id]);

header('Location: /proyecto/clientes/index.php');
exit;
