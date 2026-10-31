<?php
require_once 'conexion.php';


//asegura que el url tenga el parametro id, en caso de que no el isset devuelve falso 
// y se corta la ejecucion 
//isset se utiliza para verificar si una variable existe y que no sea nula 
if (!isset($_GET["id"])) {
    exit("No hay id");
}
//guarda la id recibida en un get 
$id = $_GET['id'];

//prepara la consulta sql con parametro {?} para que no se hagan inyecciones qsl 
$sql = $con->prepare("DELETE FROM ambulancia WHERE id = ?");
$sql->bind_param("i", $id);

//ejecuta el delete 
$sql->execute();

//se elimina el insumo desde los dos html
$volver = $_SERVER['HTTP_REFERER'] ?? '../traslado/verregistroselementos.html';
header("Location: " . $volver);
exit;