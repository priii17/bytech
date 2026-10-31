<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = (int) $_GET["id"];

$sentencia = $con->prepare("
    SELECT id, matricula, modelo
    FROM ambulancia
    WHERE id = ?
");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$ambulancia = $sentencia->get_result()->fetch_assoc();

if (!$ambulancia) {
    exit("No hay resultados para ese ID");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ambulancia</title>
    <link rel="stylesheet" href="../css/insumosyequipamientos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body class="pagina-form">

    <form class="form" id="editarambulancia" action="actualizar_ambulancia.php" method="POST">

        <p class="title">Actualizar ambulancia</p>
        <p class="message">Modificá los datos de la ambulancia.</p>

        <input type="hidden" name="id" value="<?= (int) $ambulancia['id'] ?>">

        <label>
            <input class="input" type="text" name="matricula" placeholder=" " required
                   value="<?= htmlspecialchars($ambulancia['matricula']) ?>">
            <span>Matrícula</span>
        </label>

        <label>
            <input class="input" type="text" name="modelo" placeholder=" " required
                   value="<?= htmlspecialchars($ambulancia['modelo']) ?>">
            <span>Modelo</span>
        </label>

        <button class="submit" type="submit">Guardar cambios</button>

        <p class="signin">
            <a href="../traslado/verambulancia.html.html">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </p>

    </form>

</body>
</html>