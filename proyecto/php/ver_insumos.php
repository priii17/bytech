<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM insumos");

while ($fila = $resultado->fetch_assoc()) {
    echo "<div class='archivo'>";
    echo "<h2>Insumo</h2>";

    echo "<a href='../php/eliminar_insumos.php?id=" . $fila['id'] . "'>Eliminar Insumo</a>";
    echo "<br>";
    echo "<a href='../php/editar_insumos.php?id=" . $fila['id'] . "'>Editar Insumo</a>";

    echo "<p><strong>Nombre:</strong> " . htmlspecialchars($fila['nombre']) . "</p>";
    echo "<p><strong>Descripción:</strong> " . htmlspecialchars($fila['descripcion']) . "</p>";

    echo "</div>";
    echo "<hr><br><br>";
}
?>