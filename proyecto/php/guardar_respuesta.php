<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';


$id_encuesta = $_POST['id_encuesta'];

$respuesta = $_POST['respuesta'];   


$fecha  = date('Y-m-d H:i:s');

$insertarDatos = $con->prepare(
    'INSERT INTO respuesta (id_encuesta, respuesta, fecha)
    VALUES (?, ?, ?)'
);


$insertarDatos->bind_param('iss', $id_encuesta, $respuesta,  $fecha);

$insertarDatos->execute();

echo 'ok';