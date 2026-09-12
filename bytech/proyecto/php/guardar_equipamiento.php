<?php

require_once 'conexion.php';

$n_serie = $_POST['n_serie'];
$descripcion = $_POST['descripcion'];

$insertarDatos = $con->prepare("INSERT INTO equipamiento (n_serie, descripcion) VALUES (?, ?)");

$insertarDatos->bind_param('ss', $n_serie, $descripcion);

if ($insertarDatos->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error al guardar";
}

$insertarDatos->close();
$con->close();

?>