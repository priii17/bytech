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

//prepara la consulta sql con parametro {?} para que no se hagan inlleciones qsl 
$sql = $con->prepare("DELETE FROM registro_traslado WHERE id = ?");
$sql->bind_param("i", $id);

//ejecuta el delete 
$sql->execute();

header("Location: ../traslado/Traslado.html");