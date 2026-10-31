<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["id"])) {
    exit("Solicitud inválida");
}

$id = (int) $_POST["id"];

// Busca el nombre de un funcionario a partir de su id
function nombreFuncionario($con, $id_funcionario) {
    if ($id_funcionario == 0) {
        return "";
    }

    $consulta = $con->prepare("
        SELECT p.nombre
        FROM funcionario f
        INNER JOIN personas p ON p.id = f.id
        WHERE f.id = ?
    ");
    $consulta->bind_param("i", $id_funcionario);
    $consulta->execute();
    $fila = $consulta->get_result()->fetch_assoc();
    $consulta->close();

    if ($fila) {
        return $fila['nombre'];
    }
    return "";
}

// Conductor y acompañante
$id_conductor = (int) $_POST['id_conductor'];
$id_acompaniante = (int) $_POST['id_acompaniante'];

$nombre_conductor = nombreFuncionario($con, $id_conductor);
$nombre_acompaniante = nombreFuncionario($con, $id_acompaniante);

// Si no elije  acompañante se guarda null en id 
if ($id_acompaniante == 0) {
    $id_acompaniante = null;
}


$id_ambulancia = (int) $_POST['id_ambulancia'];

$consulta = $con->prepare("SELECT modelo, matricula FROM ambulancia WHERE id = ?");
$consulta->bind_param("i", $id_ambulancia);
$consulta->execute();
$ambulancia = $consulta->get_result()->fetch_assoc();
$consulta->close();

$modelo = "";
$matricula = "";
if ($ambulancia) {
    $modelo = $ambulancia['modelo'];
    $matricula = $ambulancia['matricula'];
}

$sentencia = $con->prepare("
    UPDATE registro_traslado SET
        elemento = ?,
        id_conductor = ?,
        id_acompaniante = ?,
        nombre_conductor = ?,
        nombre_acompaniante = ?,
        id_ambulancia = ?,
        modelo = ?,
        matricula_ambulancia = ?,
        descripcionorigen = ?,
        fecha_origen = ?,
        hora_origen = ?,
        descripcion_destino = ?,
        fecha_destino = ?,
        hora_destino = ?
    WHERE id = ?
");

$sentencia->bind_param(
    "siississssssssi",
    $_POST["elemento"],
    $id_conductor,
    $id_acompaniante,
    $nombre_conductor,
    $nombre_acompaniante,
    $id_ambulancia,
    $modelo,
    $matricula,
    $_POST["descripcionorigen"],
    $_POST["fecha_origen"],
    $_POST["hora_origen"],
    $_POST["descripcion_destino"],
    $_POST["fecha_destino"],
    $_POST["hora_destino"],
    $id
);

$sentencia->execute();
$sentencia->close();

header("Location: ../traslado/Traslado.html");
exit;