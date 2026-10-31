<?php
require_once "conexion.php";

$id_encuesta = $_POST['id_encuesta'];
$valor = $_POST['valor'];

$stmt = $db->prepare('INSERT INTO respuesta (id_encuesta, valor) VALUES (?, ?)');
$stmt->bind_param('is', $id_encuesta, $valor);
$stmt->execute();