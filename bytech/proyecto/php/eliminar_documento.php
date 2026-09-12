<?php
require_once 'conexion.php';


if (!isset($_GET["id"])) {
    exit("No hay id");
}
$id = $_GET['id'];

$sql = $con->prepare("DELETE FROM documento WHERE id_documento  = ?");
$sql->bind_param("i", $id);
$sql->execute();

header("Location: ../documento/docs.html");