<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Acceso no válido");
}

$id          = (int) ($_POST['id'] ?? 0);
$n_serie     = trim($_POST['n_serie'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if ($id <= 0 || $n_serie === '' || $descripcion === '') {
    exit("Faltan datos para actualizar");
}

$sql  = "UPDATE equipamiento SET n_serie = ?, descripcion = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $con->error);
}

$stmt->bind_param("ssi", $n_serie, $descripcion, $id);

if ($stmt->execute()) {
    header("Location: ../traslado/verequipamientos.html");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>