<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
  require_once 'conexion.php';

  $resultado = $con->query("SELECT * FROM encuesta");
  $encuestas = $resultado->fetch_all(MYSQLI_ASSOC);

  foreach ($encuestas as &$e) {
    $lista = json_decode($e['preguntas'] ?? '[]', true) ?: [];
    $e['preguntas'] = $lista;
    $e['total_preguntas'] = count($lista);
  }

  echo json_encode($encuestas);
} catch (Throwable $e) {
  error_log($e->getMessage());
  http_response_code(500);
  echo json_encode(['error' => 'Error al cargar las encuestas', 'detalle' => $e->getMessage()]);
}