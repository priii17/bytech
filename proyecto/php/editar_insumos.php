<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = (int) $_GET["id"];

$sentencia = $con->prepare("
    SELECT id, nombre, descripcion
    FROM insumos
    WHERE id = ?
");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$insumo = $sentencia->get_result()->fetch_assoc();

if (!$insumo) {
    exit("No hay resultados para ese ID");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar insumo</title>
    <link rel="stylesheet" href="../css/insumosyequipamientos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body class="pagina-form">

    <form class="form" id="editarinsumo" action="actualizar_insumos.php" method="POST">

        <p class="title">Actualizar insumo</p>
        <p class="message">Modificá los datos del insumo.</p>

        <input type="hidden" name="id" value="<?= (int) $insumo['id'] ?>">

        <label>
            <input class="input" type="text" name="nombre" placeholder=" " required
                   value="<?= htmlspecialchars($insumo['nombre']) ?>">
            <span>Nombre</span>
        </label>

        <label>
            <input class="input" type="text" name="descripcion" placeholder=" " required
                   value="<?= htmlspecialchars($insumo['descripcion']) ?>">
            <span>Descripción</span>
        </label>

        <button class="submit" type="submit">Guardar cambios</button>

        <p class="signin">
            <a href="../traslado/verinsumos.html">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </p>

    </form>

</body>
</html>