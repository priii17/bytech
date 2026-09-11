<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM documento");

while ($fila = $resultado->fetch_assoc()) {

    echo "<div class='archivo'>";

    echo "<h2> Documentos </h2>";
  
    echo "<p><strong>Nombre:</strong> " . $fila['nombre_documento'] . "</p>";
    echo "<p><strong>Tipo:</strong> " . $fila['tipo_documento'] . "</p>";

    echo "<a href='../php/editar_documento.php?id=" . $fila['id'] . "' class='editar'>";
    echo "Editar documento" ;
    echo "</a>";

    echo "<a href='../php/eliminar_documento.php?id=" . $fila['id'] . "' class='eliminar'
     onclick='return confirm(\"¿Estás seguro de que deseas eliminar este documento?\")'>";
    echo "Eliminar documento";
    echo "</a>";

    echo "</div>";

   
}
   
?>