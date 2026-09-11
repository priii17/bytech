<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM documento");

while ($fila = $resultado->fetch_assoc()) {

    echo "<div class='archivo'>";

    echo "<h2>📄 Documentos </h2>";

     
    echo "<a href='editardocumento.php ?id=" . $fila['id'] . "' class='editar'>";
    echo "✏️";
    echo "</a>";
  
    echo "<p><strong>Nombre:</strong> " . $fila['nombre_documento'] . "</p>";
    echo "<p><strong>Tipo:</strong> " . $fila['tipo_documento'] . "</p>";

    echo "</div>";

    echo "<hr>";
}
   
?>