<?php
$lat = isset($_POST['lat']) ? floatval($_POST['lat']) : null;
$lng = isset($_POST['lng']) ? floatval($_POST['lng']) : null;

if ($lat === null || $lng === null || ($lat == 0 && $lng == 0)) {
    die('Primero tenés que ubicar la dirección');
}

$stmt = $conexion->prepare("UPDATE coordenadas SET latitud = ?, longitud = ? WHERE id = ?");
$stmt->bind_param("ddi", $lat, $lng, $id);
$stmt->execute();