<?php

require_once 'conexion.php';

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$insertarDatos = $con->prepare("INSERT INTO insumos (nombre, descripcion) VALUES (?, ?)");

$insertarDatos->bind_param('ss', $nombre, $descripcion);

if ($insertarDatos->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error al guardar";
}

$insertarDatos->close();
$con->close();

?>
