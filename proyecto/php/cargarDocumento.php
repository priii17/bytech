<?php 

echo "TEST";
error_reporting(E_ALL);
ini_set('display_errors', 1);



require_once 'conexion.php';

$nombre = $_POST['nombre'];
$documento= $_FILES['documento'];
$tipo = $_POST['tipo'];

   $ruta = "/tmp/" . basename($documento['name']);

    if (move_uploaded_file($documento['tmp_name'], $ruta)) {

 

        // Por ahora usamos la ruta como dato del QR
        $qr = $ruta;

  
    $insertarDoc =$con->prepare("INSERT INTO documento(nombre_documento,tipo_documento,qr) VALUES (?,?,?)");
    $insertarDoc->bind_param('sss', $nombre,$tipo,$qr);

if($insertarDoc->execute()){
   echo "Guardado correctamente";

    
}else{
    echo "sapa" ;
}
$insertarDoc->close();
}
?>
