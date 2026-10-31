<?php
header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    require_once 'conexion.php';

    $resultado = $con->query("
        SELECT id, n_serie, descripcion
        FROM equipamiento
        ORDER BY n_serie
    ");

    echo json_encode($resultado->fetch_all(MYSQLI_ASSOC));
} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Error al cargar el equipamiento']);
}