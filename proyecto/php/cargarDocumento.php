<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conexion.php';

$nombre = $_POST['nombre'];
$documento= $_FILES['documento'];
$tipo = $_POST['tipo'];

if($documento['error']===0){
    move_uploaded_file($documento['tmp_name'], "../documentos/" . $documento['name']);
  
    $insertarDoc =$con->prepare("INSERT INTO documento(nombre_documento,tipo_documento) VALUES (?,?)");
    $insertarDoc->bind_param('ss', $nombre,$tipo);

if($insertarDoc->execute()){
   echo "Guardado correctamente";

    }else{
     echo "Error al guardar";
}
$insertarDoc->close();

}else{
    echo "ERROR";
}
?>

