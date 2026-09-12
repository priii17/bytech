<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

$cedula = $_POST['cedula'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nacimiento = $_POST['nacimiento'];
$email = $_POST['email'];
$contrasenia = $_POST['contrasenia'];
$usuario = $_POST['usuario'];

$hash = password_hash($contrasenia, PASSWORD_BCRYPT);

$insertarDatos = $con->prepare("INSERT INTO personas (cedula,nombre,apellido,fecha_nacimiento) VALUES (?,?,?,?)");
$insertarDatos->bind_param('isss', $cedula, $nombre, $apellido, $nacimiento);
$insertarDatos->execute();

$id_fk = $con->insert_id;


$insertarFuncionario = $con->prepare("INSERT INTO funcionario (id, usuario, contrasenia, email) VALUES (?,?,?,?)");
$insertarFuncionario->bind_param('isss', $id_fk, $usuario, $hash, $email);

if ($insertarFuncionario->execute()) {
    echo "Funcionario guardado correctamente";
} else {
    echo "No se guardo funcionario";
}

$con->close();
?>