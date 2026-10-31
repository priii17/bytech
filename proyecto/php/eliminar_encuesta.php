<?php
require_once 'conexion.php';

if (!isset($_GET["id"])) {
    exit("No hay id");
}

$id = (int) $_GET['id'];

$con->begin_transaction();

try {

    // Eliminar respuestas asociadas
    $sql = $con->prepare("DELETE FROM respuesta WHERE id_encuesta = ?");
    $sql->bind_param("i", $id);
    $sql->execute();

    // Eliminar encuesta
    $sql = $con->prepare("DELETE FROM encuesta WHERE id = ?");
    $sql->bind_param("i", $id);
    $sql->execute();

    $con->commit();

    header("Location: ../encuestas/encuestas.html");
    exit();

} catch (Exception $e) {

    $con->rollback();
    echo "Error al eliminar: " . $e->getMessage();
}