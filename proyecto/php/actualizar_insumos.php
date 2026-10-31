<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit("Acceso no válido");
}

$id          = (int) ($_POST['id'] ?? 0);
//trim() elimina los espacios al principio y al final del texto.
$nombre      = trim($_POST['nombre'] ?? '');
$descripcion = trim($_POST['descripcion'] ?? '');

if ($id <= 0 || $nombre === '' || $descripcion === '') {
    exit("Faltan datos para actualizar");
}

$sql  = "UPDATE insumos SET nombre = ?, descripcion = ? WHERE id = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Error al preparar la consulta: " . $con->error);
}

$stmt->bind_param("ssi", $nombre, $descripcion, $id);

if ($stmt->execute()) {
    header("Location: ../traslado/verinsumos.html");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>