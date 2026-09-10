<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conexion.php';


$elemento = $_POST['elemento'] ;


$id_conductor =$_POST['id_conductor'];
$nombre_conductor =$_POST['nombre_conductor'];


$id_acompaniante =$_POST['id_acompaniante'];
$nombre_acompaniante =$_POST['nombre_acompaniante'];

$id_ambulancia =$_POST['id_ambulancia'];
$modelo = $_POST['modelo'];
$matricula_ambulancia =$_POST['matricula_ambulancia'];

$descripcionorigen  = $_POST['descripcionorigen'];
$fecha_origen  = $_POST['fecha_origen'];
$hora_origen=$_POST['hora_origen'];

$descripcion_destino = $_POST['descripcion_destino'];
$fecha_destino = $_POST['fecha_destino'];
$hora_destino =$_POST['hora_destino'];

$ruta = $_POST['ruta'];
$descripcionruta =$_POST['descripcionruta'];




$insertarDatos = $con ->prepare ("INSERT INTO  registro_traslado
 ( 
 elemento,
 id_conductor,
 nombre_conductor,
 id_acompaniante,
 nombre_acompaniante,
 id_ambulancia,
 modelo,
 matricula_ambulancia,
 descripcionorigen,
 fecha_origen,
 hora_origen,
 descripcion_destino,
 fecha_destino,
 hora_destino,
 ruta,
 descripcionruta
 ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$insertarDatos->bind_param ('sisisissssississ',
$elemento,
$id_conductor,
$nombre_conductor,
$id_acompaniante,
$nombre_acompaniante,
$id_ambulancia,
$modelo,
$matricula_ambulancia,
$descripcionorigen,
$fecha_origen,
$hora_origen,
$descripcion_destino,
$fecha_destino,
$hora_destino,
$ruta,
$descripcionruta);


if($insertarDatos->execute()){
echo "enviado";

}else{
     echo "Error al guardar";

}
$insertarDatos->close();


?>