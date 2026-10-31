<?php
require_once 'conexion.php';


$id     = $_POST['id'];
$nombre = $_POST['nombre'];


$sql = "UPDATE documento SET nombre_documento = ? WHERE id = ?";
$stmt = $con->prepare($sql);


if (!$stmt) {
    die("Error al preparar la consulta: " . $con->error);
}


$stmt->bind_param("si", $nombre, $id);


if ($stmt->execute()) {
    header("Location: ../documento/docs.html");
    exit();
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>