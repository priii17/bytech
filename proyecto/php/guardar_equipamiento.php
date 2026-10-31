<?php

require_once 'conexion.php';

$n_serie = $_POST['n_serie'];
$descripcion = $_POST['descripcion'];

$insertarDatos = $con->prepare("INSERT INTO equipamiento (n_serie, descripcion) VALUES (?, ?)");

$insertarDatos->bind_param('ss', $n_serie, $descripcion);


  $exito = $insertarDatos->execute();
$insertarDatos->close();

if ($exito) {
    header('Location: ../traslado/verequipamientos.html');
    exit; // siempre cortar la ejecución después de un header Location
} else {
    // manejar el error, por ejemplo mostrar un mensaje
    echo "Error al guardar el traslado";
}



?>