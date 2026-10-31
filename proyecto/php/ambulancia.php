<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once 'conexion.php';

//* recibe datos de html por POST*//
$matricula = $_POST['matricula'];

$modelo = $_POST['modelo'];

// prepara la consulta SQL
// que se completan después con bind_param — esto evita inyección SQL,
// porque los datos nunca se pegan directo dentro del texto de la consulta
$insertarDatos = $con->prepare("INSERT INTO ambulancia (matricula,modelo) VALUES (?,?)");



//* asocia los ?? con una variable existente *//
$insertarDatos->bind_param(
    'ss',
    $matricula,
    $modelo
);

//* ejecuta la consulta en la BD*//
if($insertarDatos->execute()){
   echo "<script>";
    echo "window.location.href = '../traslado/verambulancia.html';";
    echo "</script>";

    exit;



}else{
     echo "Error al guardar";

}
$insertarDatos->close();


?>
