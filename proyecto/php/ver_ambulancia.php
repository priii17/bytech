<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM ambulancia");

while ($fila = $resultado->fetch_assoc()) {
    echo "<div class='archivo'>";
    echo "<h2>Ambulancia</h2>";

    echo "<a href='../php/eliminar_ambulancia.php?id=" . $fila['id'] . "'>Eliminar Ambulancia</a>";
    echo "<br>";
    echo "<a href='../php/editar_ambulancia.php?id=" . $fila['id'] . "'>Editar Ambulancia</a>";

    echo "<p><strong>Matrícula:</strong> " . htmlspecialchars($fila['matricula']) . "</p>";
    echo "<p><strong>Modelo:</strong> " . htmlspecialchars($fila['modelo']) . "</p>";

    echo "</div>";
    echo "<hr><br><br>";
}
?>