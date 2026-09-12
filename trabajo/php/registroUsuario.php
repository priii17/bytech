<?php
require_once 'conexion.php';

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];
$fecha = $_POST['fecha'];
$email = $_POST['email'];
$contrasenia = $_POST['contrasenia'];
$codigo = $_POST['codigo'];

$hash = password_hash($contrasenia, PASSWORD_BCRYPT);

$sentencia = $con->prepare("INSERT INTO funcionario(usuario, contrasenia, email) VALUES (?,?,?)");
$sentencia->bind_param('sss', $nombre, $hash, $email);

if($sentencia->execute()){
    echo "ok";
}else{
    echo "error";
}

$sentencia->close();
$con->close();
?>