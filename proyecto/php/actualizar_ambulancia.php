<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Acceso no válido");
}

$id          = (int) ($_POST['id'] ?? 0);
$matricula     = trim($_POST['matricula'] ?? '');
$modelo = trim($_POST['modelo'] ?? '');

if ($id <= 0 || $matricula === '' || $modelo === '') {
    exit("Faltan datos para actualizar");
}

$sql  = "UPDATE ambulancia SET matricula = ?, modelo = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $con->error);
}

$stmt->bind_param("ssi", $matricula, $modelo, $id);

if ($stmt->execute()) {
    header("Location: ../traslado/verambulancia.html");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>