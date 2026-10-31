<?php 
require_once 'conexion.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

$nombre = $_POST['nombre'];

$documento= $_FILES['documento'];


if($documento['error']===0){

    // variable con nombre del archivo
    $nombreArchivo = $documento['name'];

    // mueve el archivo a la carpeta documentos 
    move_uploaded_file($documento['tmp_name'], "../documentos/" . $nombreArchivo);

     // variable con la url del archivo
      $url = "https://" . $_SERVER['HTTP_HOST'] .  "/proyectos/bytech/proyecto/documentos/" . $nombreArchivo;
  
    $insertarDoc =$con->prepare("INSERT INTO documento(nombre_documento,qr) VALUES (?,?)");
    $insertarDoc->bind_param('ss', $nombre,$url);

if($insertarDoc->execute()){
   echo $url;

    }else{
     echo "Error al guardar";
}
$insertarDoc->close();

}else{
    echo "Ocurrió un error al subir el archivo.";
}
?>

