<?php
header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', 0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    require_once 'conexion.php';

    $tipo = $_GET['tipo'] ?? '';

    if (!in_array($tipo, ['conductor', 'acompaniante'], true)) {
        http_response_code(400);
        echo json_encode(['error' => 'Tipo inválido']);
        exit;
    }


    $resultado = $con->query("
        SELECT f.id, p.nombre
        FROM funcionario f
        INNER JOIN personas p ON p.id = f.id
        ORDER BY p.nombre
    ");

    echo json_encode($resultado->fetch_all(MYSQLI_ASSOC));
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}