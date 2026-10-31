<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = (int) $_GET["id"];

$sentencia = $con->prepare("
    SELECT id, n_serie, descripcion
    FROM equipamiento
    WHERE id = ?
");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$equipamiento = $sentencia->get_result()->fetch_assoc();

if (!$equipamiento) {
    exit("No hay resultados para ese ID");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar equipamiento</title>
    <link rel="stylesheet" href="../css/insumosyequipamientos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body class="pagina-form">

    <form class="form" id="editarequipamiento" action="actualizar_equipamiento.php" method="POST">

        <p class="title">Actualizar equipamiento</p>
        <p class="message">Modificá los datos del equipamiento.</p>

        <input type="hidden" name="id" value="<?= (int) $equipamiento['id'] ?>">

        <label>
            <input class="input" type="text" name="n_serie" placeholder=" " required
                   value="<?= htmlspecialchars($equipamiento['n_serie']) ?>">
            <span>Número de serie</span>
        </label>

        <label>
            <input class="input" type="text" name="descripcion" placeholder=" " required
                   value="<?= htmlspecialchars($equipamiento['descripcion']) ?>">
            <span>Descripción</span>
        </label>

        <button class="submit" type="submit">Guardar cambios</button>

        <p class="signin">
            <a href="../traslado/equipamiento.html">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </p>

    </form>

</body>
</html>