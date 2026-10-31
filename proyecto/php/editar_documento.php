<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = $_GET["id"];

$sentencia = $con->prepare("
    SELECT
        id,
        nombre_documento
    FROM documento
    WHERE id= ?
");

$sentencia->bind_param("i", $id);
$sentencia->execute();

$resultado = $sentencia->get_result();

$documento = $resultado->fetch_assoc();

if (!$documento) {
    exit("No hay resultados para ese ID");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar documento</title>
    <link rel="stylesheet" href="../css/documento.css">
</head>

<body class="bodydoc">


<main>
<form action="actualizar_documento.php" method="POST" class="form" >

 
  <h2 class="titulo">Editar <b>Documento</b></h2>
        <p class="message">Editar los datos del documento.</p>
        

         

    <input type="hidden" name="id"
           value="<?php echo $documento['id']; ?>">

  
  
        <label>
        <input type="text"
             name="nombre"
               value="<?php echo htmlspecialchars($documento['nombre_documento']); ?>"
           placeholder=" "
           required>
          <span>Nombre del documento</span>
            </label>
       

        <button class="guardar" type="submit" id="btn">Guardar cambios</button>

        <p class="signin">
          <a href="../documento/docs.html"> <i class="fa-solid fa-arrow-left"></i> Volver </a>
        </p>

</form>
</main>
</body>
</html>