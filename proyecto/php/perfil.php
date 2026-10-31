<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header("Content-Type: application/json; charset=utf-8");
require_once 'conexion.php';

// Si el login no guardó el usuario, no hay sesión iniciada
if (!isset($_SESSION["usuario"])) {
    http_response_code(401);
    echo json_encode(["error" => "Tenés que iniciar sesión"]);
    exit;
}

$usuario = $_SESSION["usuario"];

// join une las tablas funcionario y personas con el id 
$stmt = $con->prepare(
    "SELECT p.nombre, p.cedula, p.apellido, f.email
     FROM funcionario f
     JOIN personas p ON p.id = f.id
     WHERE f.usuario = ?"
);
$stmt->bind_param("s", $usuario);  
$stmt->execute();
$perfil = $stmt->get_result()->fetch_assoc();


if ($perfil) {
    echo json_encode($perfil);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Perfil no encontrado"]);
}

$stmt->close();

?>