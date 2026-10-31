<?php
require_once "conexion.php"; 

header("Content-Type: application/json");

$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos["id_traslado"],  $datos["latitud"], $datos["longitud"])
    || !in_array($datos["tipo"], ["origen", "destino"])) {
    echo json_encode(["ok" => false, "mensaje" => "Datos incompletos"]);
    exit;
}

$stmt = $con->prepare("INSERT INTO coordenadas (id_traslado, latitud, longitud) VALUES (?,  ?, ?)");
$stmt->bind_param("idd", $datos["id_traslado"], $datos["latitud"], $datos["longitud"]);

if ($stmt->execute()) {
    echo json_encode(["ok" => true]);
} else {
    echo json_encode(["ok" => false, "mensaje" => "Error al guardar"]);
}

$stmt->close();
$con->close();