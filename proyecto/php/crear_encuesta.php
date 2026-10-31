<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 0);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
  require 'conexion.php';   

  $data = json_decode(file_get_contents('php://input'), true);
  if (!$data || empty($data['titulo']) || empty($data['preguntas'])) {
    http_response_code(400);
    echo json_encode(['mensaje' => 'Faltan datos']);
    exit;
  }

  $titulo = $data['titulo'];
  $descripcion = $data['descripcion'] ?? '';
  $preguntas = json_encode($data['preguntas'], JSON_UNESCAPED_UNICODE);

  $st = $con->prepare("INSERT INTO encuesta (titulo, descripcion, preguntas) VALUES (?, ?, ?)");
  $st->bind_param("sss", $titulo, $descripcion, $preguntas);
  $st->execute();

  echo json_encode(['mensaje' => 'Encuesta creada']);
} catch (Throwable $e) {
  error_log($e->getMessage());
  http_response_code(500);
  echo json_encode(['mensaje' => 'Error al guardar: ' . $e->getMessage()]);
}