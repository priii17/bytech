<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

function nombreFuncionario($con, $id) {
    if ($id === null) return null;
    $s = $con->prepare("SELECT p.nombre FROM funcionario f INNER JOIN personas p ON p.id = f.id WHERE f.id = ?");
    $s->bind_param('i', $id);
    $s->execute();
    $fila = $s->get_result()->fetch_assoc();
    $s->close();
    return $fila ? $fila['nombre'] : null;
}


function datosAmbulancia($con, $id) {
    $s = $con->prepare("SELECT modelo, matricula FROM ambulancia WHERE id = ?");
    $s->bind_param('i', $id);
    $s->execute();
    $fila = $s->get_result()->fetch_assoc();
    $s->close();
    return $fila;
}

function insumos($con, $id) {
    if ($id === null) return null;
    $s = $con->prepare("SELECT nombre, descripcion FROM insumos  WHERE id = ?");
    $s->bind_param('i', $id);
    $s->execute();
    $fila = $s->get_result()->fetch_assoc();
    $s->close();
    return $fila;
}

function equipamiento($con, $id) {
    if ($id === null) return null;
    $s = $con->prepare("SELECT n_serie,descripcion FROM equipamiento  WHERE id = ?");
    $s->bind_param('i', $id);
    $s->execute();
    $fila = $s->get_result()->fetch_assoc();
    $s->close();
    return $fila;
}




$elemento = $_POST['elemento'] ;


$id_conductor = (int) $_POST['id_conductor'];
$id_acompaniante = !empty($_POST['id_acompaniante']) ? (int) $_POST['id_acompaniante'] : null;

$nombre_conductor = nombreFuncionario($con, $id_conductor);
$nombre_acompaniante = nombreFuncionario($con, $id_acompaniante);

$id_ambulancia = (int) $_POST['id_ambulancia'];
$ambulancia = datosAmbulancia($con, $id_ambulancia);

if (!$ambulancia) {
    http_response_code(400);
    exit("Ambulancia inválida");
}

$modelo = $ambulancia['modelo'];
$matricula_ambulancia = $ambulancia['matricula'];

$descripcionorigen  = $_POST['descripcionorigen'];
$fecha_origen  = $_POST['fecha_origen'];
$hora_origen=$_POST['hora_origen'];

$descripcion_destino = $_POST['descripcion_destino'];
$fecha_destino = $_POST['fecha_destino'];
$hora_destino =$_POST['hora_destino'];





 //se hace la consulta sql con parametro ? para que no se hagan inyeciones qsl asi nomas 
$insertarDatos = $con ->prepare ("INSERT INTO  registro_traslado
 ( 
 elemento,   
 id_conductor,
 id_acompaniante,
 nombre_conductor,
 nombre_acompaniante,
 id_ambulancia,
 modelo,
 matricula_ambulancia,
 descripcionorigen,
 fecha_origen,
 hora_origen,
 descripcion_destino,
 fecha_destino,
 hora_destino
 
 ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

//asocia los parametros con una variable existente 
$insertarDatos->bind_param ('siississssssss',
$elemento,
$id_conductor,
$id_acompaniante,
$nombre_conductor,
$nombre_acompaniante,
$id_ambulancia,
$modelo,
$matricula_ambulancia,
$descripcionorigen,
$fecha_origen,
$hora_origen,
$descripcion_destino,
$fecha_destino,
$hora_destino);


$exito = $insertarDatos->execute();
$id_traslado = $con->insert_id;   
$insertarDatos->close();

if ($exito) {
    header('Location: ../traslado/Traslado.html');
    exit; // siempre cortar la ejecución después de un header Location
} else {
    // manejar el error, por ejemplo mostrar un mensaje
    echo "Error al guardar el traslado";
}


?>