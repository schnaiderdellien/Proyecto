<?php
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/proyecto/includes/db.php';

$id = $_GET['id'] ?? null;

// Si no hay ID, volvemos al listado
if (!$id) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

// Comprobar que el producto existe
$stmt = $pdo->prepare("SELECT id FROM productos WHERE id = ?");
$stmt->execute([$id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$producto) {
    header('Location: /proyecto/productos/index.php');
    exit;
}

// Baja lógica
$update = $pdo->prepare(
    "UPDATE productos 
     SET activo = 0, fecha_baja = NOW()
     WHERE id = ?"
);
$update->execute([$id]);

header('Location: /proyecto/productos/index.php');
exit;
