<?php
require_once "conexion.php";

$resultado = $con->query ("SELECT * FROM registro_traslado");

while ($fila = $resultado->fetch_assoc()) {

    echo "<div class='archivo'>";

    echo "<h2>📄 Traslados </h2>";

     
    
    
    echo "<a href='../php/eliminar_registro.php?id=" . $fila['id'] . "'>❌</a>";
    echo "<a href='../php/editar_registro.php?id=" . $fila['id'] . "'>✏️</a>";

    echo "<p><strong>Elemento:</strong> " . $fila['elemento'] . "</p>";

    echo "<h3>Conductor</h3>";
    echo "<p>ID: " . $fila['id_conductor'] . "</p>";
    echo "<p>Nombre: " . $fila['nombre_conductor'] . "</p>";

    echo "<h3>Acompañante</h3>";
    echo "<p>ID: " . $fila['id_acompaniante'] . "</p>";
    echo "<p>Nombre: " . $fila['nombre_acompaniante'] . "</p>";

    echo "<h3>Ambulancia</h3>";
    echo "<p>ID: " . $fila['id_ambulancia'] . "</p>";
    echo "<p>Matrícula: " . $fila['matricula_ambulancia'] . "</p>";
    echo "<p>Modelo: " . $fila['modelo'] . "</p>";

    echo "<h3>Origen</h3>";
    echo "<p>Fecha: " . $fila['fecha_origen'] . "</p>";
    echo "<p>Hora: " . $fila['hora_origen'] . "</p>";
    echo "<p>Descripción: " . $fila['descripcionorigen'] . "</p>";

    echo "<h3>Destino</h3>";
    echo "<p>Fecha: " . $fila['fecha_destino'] . "</p>";
    echo "<p>Hora: " . $fila['hora_destino'] . "</p>";
    echo "<p>Descripción: " . $fila['descripcion_destino'] . "</p>";

    echo "<h3>Ruta</h3>";
    echo "<p>Tipo: " . $fila['ruta'] . "</p>";
    echo "<p>Descripción: " . $fila['descripcionruta'] . "</p>";

    echo "</div>";

    echo "<hr>";
}
?>