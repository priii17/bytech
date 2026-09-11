<?php
require_once 'conexion.php';


$id     = $_POST['id'];
$nombre = $_POST['nombre'];
$tipo   = $_POST['tipo'];

$sql = "UPDATE documento SET nombre_documento = ?, tipo_documento = ? WHERE id = ?";
$stmt = $con->prepare($sql);


if (!$stmt) {
    die("Error al preparar la consulta: " . $con->error);
}


$stmt->bind_param("ssi", $nombre, $tipo, $id);


if ($stmt->execute()) {
    header("Location: ../documento/docs.html");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>