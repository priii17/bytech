<?php
include_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = $_GET["id"];

$sentencia = $con->prepare("
    SELECT
        id_documento,
        nombre_documento,
        tipo_documento
    FROM documento
    WHERE id_documento = ?
");

$sentencia->bind_param("i", $id);
$sentencia->execute();

$resultado = $sentencia->get_result();

$documento = $resultado->fetch_assoc();

if (!$documento) {
    exit("No hay resultados para ese ID");
}
?>

<body class="body2">
<h1>Actualizar documento</h1>

<form action="./actualizar_documento.php" method="POST" class="contenedor3">
    <link rel="stylesheet" href="../css/documento.css">

    <!-- ID -->
    <input type="hidden" name="id"
           value="<?php echo $documento['id_documento']; ?>">

  
    <p>Nombre del documento:</p>

    <input type="text"
           name="nombre"
           value="<?php echo htmlspecialchars($documento['nombre_documento']); ?>"
           placeholder="Nombre del documento"
           required>

    <br><br>

 
    <p>Tipo de documento:</p>

    <input type="text"
           name="tipo"
           value="<?php echo htmlspecialchars($documento['tipo_documento']); ?>"
           placeholder="Tipo de documento"
           required>

    <br><br>

    
    <button type="submit">
        Guardar cambios
    </button>

    <a href="./docs.html">
        Volver
    </a>

</form>
</body>