<?php
include_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = $_GET["id"];

$sentencia = $con->prepare("
    SELECT
        id,
        nombre_documento,
        tipo_documento
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

<body class="body3">
<h2>Actualizar documento</h2>

<div class="formulario">
<form action="actualizar_documento.php" method="POST">
    <link rel="stylesheet" href="../css/documento.css">

   
    <input type="hidden" name="id"
           value="<?php echo $documento['id']; ?>">

  
    <div class="campoeditar">
        <label>Nombre del documento:</label>
        <input type="text"
               name="nombre"
               value="<?php echo htmlspecialchars($documento['nombre_documento']); ?>"
           placeholder="Nombre del documento"
           required>

           </div>
    <br><br>


 <div class="campoeditar">
    <label>Tipo de documento:</label>

    <input type="text"
           name="tipo"
           value="<?php echo htmlspecialchars($documento['tipo_documento']); ?>"
           placeholder="Tipo de documento"
           required>
</div>
    <br><br>

    
    <button type="submit">
        Guardar cambios
    </button>

    <a href="../documento/docs.html">
        Volver
    </a>
</div>
</form>
</body>