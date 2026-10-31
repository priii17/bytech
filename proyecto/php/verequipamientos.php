<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM equipamiento");

while ($fila = $resultado->fetch_assoc()) {
    echo "<div class='archivo'>";
    echo "<h2>Equipamiento</h2>";

    echo "<a href='../php/eliminar_equipamiento.php?id=" . $fila['id'] . "'>Eliminar Equipamiento</a>";
    echo "<br>";
    echo "<a href='../php/editar_equipamiento.php?id=" . $fila['id'] . "'>Editar Equipamiento</a>";

    echo "<p><strong>Número de serie:</strong> " . htmlspecialchars($fila['n_serie']) . "</p>";
    echo "<p><strong>Descripción:</strong> " . htmlspecialchars($fila['descripcion']) . "</p>";

    echo "</div>";
    echo "<hr><br><br>";
}
?>

