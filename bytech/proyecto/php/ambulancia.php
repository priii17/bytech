<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once 'conexion.php';


$matricula = $_POST['matricula'];



$modelo = $_POST['modelo'];


$insertarDatos = $con->prepare("INSERT INTO ambulancia (matricula,modelo) VALUES (?,?)");

$insertarDatos->bind_param(
    'ss',
    $matricula,
    $modelo
);


if($insertarDatos->execute()){
   echo "<script>";
    echo "window.location.href = '../traslado/Traslado.html';";
    echo "</script>";

    exit;



}else{
     echo "Error al guardar";

}
$insertarDatos->close();


?>
