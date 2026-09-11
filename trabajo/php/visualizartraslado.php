<?php 

require_once 'conexion.php';

$elemento = $_POST['elemento'];



$conductor = $_POST['conductor'];
$CI_conductor =$_POST['CI_conductor'];


$acompaniante = $_POST['acompaniante'];
$CI_acompaniante =$_POST['CI_acompaniante'];

$modelo = $_POST['modelo'];
$matricula =$_POST['matricula'];


$fecha_origen  = $_POST['fecha_origen'];
$hora_origen=$_POST['hora_origen'];

$fecha_destino = $_POST['fecha_destino'];
$hora_destino =$_POST['hora_destino'];

$ruta = $_POST['ruta'];
$descripcionruta =$_POST['descripcionruta'];




$insertarDatos = $con ->prepare("INSERT INTO registro_traslado (elemento,conductor,CI_conductor,acompaniante,CI_acompaniante,
modelo,matricula,fecha_origen,hora_origen,fecha_destino,hora_destino,ruta,descripcionruta) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");

$insertarDatos->bind_param('sssssssssssss', $elemento,$conductor,$CI_conductor,$acompaniante,
$CI_acompaniante,$modelo,$matricula,$fecha_origen,$horaorigen,$fecha_destino,$hora_destino,$ruta,$descripcionruta)

;

if($insertarDatos->execute()){
   echo "Registro exitoso";
}else{
     echo "Error al guardar";
}
$insertarDatos->close();

?>
