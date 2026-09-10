<?php 

require_once 'conexion.php';

session_start();

$usuario= $_POST['usuario'];
$contrasenia= $_POST['contrasenia'];

$buscarUsuario=$con->prepare("SELECT usuario,password_hash FROM funcionario WHERE usuario=?");
$buscarUsuario->bind_param('s', $usuario);
$buscarUsuario->execute();

$resultado=$buscarUsuario->get_result();

if($resultado->num_rows===0){
    echo "error";
    exit;
}

$fila=$resultado->fetch_assoc();

header('content-type: application/json');

if(password_verify($contrasenia,$fila['password_hash'])){
    $_SESSION['usuario']=$fila['usuario'];
    $_SESSION['contrasenia']=$fila['contrasenia'];
    $_SESSION['email']=$fila['email'];

    
echo json_encode([
    'Exito' => true,
    'usuario' => $fila]);
}else 
echo json_encode(['error' => 'Contraseña incorrecta']);

$buscarUsuario -> close();
$con->close();
?>