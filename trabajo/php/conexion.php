<?php

require_once 'config.php';

$con=new mysqli(BD_host,BD_usuario,BD_contrasenia,BD_nombre);

if($con -> connect_error){
    die("Error de conexion:" . $con -> connect_error);
}
echo "Exito";


?>