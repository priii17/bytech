<?php
require_once 'conexion.php';


if (!isset($_GET["id"])) {
    exit("No hay id");
}
$id = $_GET['id'];

$sql = $con->prepare("DELETE FROM registro_traslado WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();

header("Location: ../traslado/Traslado.html");