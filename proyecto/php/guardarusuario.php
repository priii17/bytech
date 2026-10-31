<?php

require_once 'iniciarSesion.php';

session_start();
 
// Si la variable de sesión está vacía, esto 
// significa que el usuario aún no ha iniciado sesión
// El usuario será redirigido a index(login)
// para permitirle iniciar sesión
if (!isset($_SESSION['usuario'])) {
    $_SESSION['msg'] = "You have to log in first";
    header('location: index.php');
    exit;
}
 
// El botón de cierre de sesión destruirá la sesión y
// eliminará las variables de sesión.
// El usuario será redirigido a 'login.php'
// tras cerrar la sesión.
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['usuario']);
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" type=""
                    href="../css/FuncionarioPC.css">
</head>
<body>
    <div class="header">
        <h2>Home Page</h2>
    </div>
    <div class="content">
 
        <!-- Creación de una notificación cuando el
                usuario inicia sesión -->
        
        <!-- Accesible solo para los usuarios que
                ya han iniciado sesión -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error puta" >
                <h3>
                    <?php
                        echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
 
     <!-- información del usuario que ha iniciado sesión -->
        <!-- mensaje de bienvenida para el usuario que ha iniciado sesión -->
        <?php  if (isset($_SESSION['usuario'])) : ?>
            


<p>
                Welcome 
                <strong>
                    <?php echo $_SESSION['usuario']; ?>
                </strong>
            </p>



            


<p> 
                <a href="guardarusuario.php?logout='1'" style="color: red;">
                    Click here to Logout
                </a>
            </p>



        <?php endif ?>
    </div>
</body>
</html>