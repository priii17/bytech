
<?php

require_once "conexion.php";

//llama las variables de documento
$resultado = $con->query("SELECT * FROM registro_traslado");


echo "<div class='card'>";
function h($valor) {
    return htmlspecialchars($valor ?? '-', ENT_QUOTES, 'UTF-8');
}


if ($resultado->num_rows == 0) {
    echo "<p>No hay registros cargados.</p>";
} else{
  echo "<div class='grid-traslados'>";
    // Se abre la tabla y se escriben los títulos UNA sola vez
 

    $no=1; // Variable para llevar el conteo de los documentos
  
    // fetch_assoc() devuelve una fila como array asociativo 
  //  y avanza automáticamente al siguiente documento en cada vuelta del while.
// Cuando ya no quedan filas, fetch_assoc() devuelve null y el while corta solo

while ($fila = $resultado->fetch_assoc()) {
       echo "<div class='traslado-item'>";
  
 echo "<p><strong>Elemento:</strong> " . h($fila['elemento']) . "</p>";

    echo "<h3>Conductor</h3>";
    echo "<p>ID: " . h($fila['id_conductor']) . "</p>";
    echo "<p>Nombre: " . h($fila['nombre_conductor']) . "</p>";

    echo "<h3>Acompañante</h3>";
    echo "<p>ID: " . h($fila['id_acompaniante']) . "</p>";
    echo "<p>Nombre: " . h($fila['nombre_acompaniante']) . "</p>";

    echo "<h3>Ambulancia</h3>";
    echo "<p>ID: " . h($fila['id_ambulancia']) . "</p>";
    echo "<p>Matrícula: " . h($fila['matricula_ambulancia']) . "</p>";
    echo "<p>Modelo: " . h($fila['modelo']) . "</p>";

    echo "<h3>Origen</h3>";
    echo "<p>Fecha: " . h($fila['fecha_origen']) . "</p>";
    echo "<p>Hora: " . h($fila['hora_origen']) . "</p>";
    echo "<p>Descripción: " . h($fila['descripcionorigen']) . "</p>";

    echo "<h3>Destino</h3>";
    echo "<p>Fecha: " . h($fila['fecha_destino']) . "</p>";
    echo "<p>Hora: " . h($fila['hora_destino']) . "</p>";
    echo "<p>Descripción: " . h($fila['descripcion_destino']) . "</p>";

                  echo "<a href='../php/editartraslado.php?id=" . $fila['id'] . "' class='editar' title='Editar'>";
        echo "<i class='fa-solid fa-pen-to-square'></i>";
        echo "</a> ";
           
        echo "<a href='../php/eliminar_registrotraslado.php?id=" . $fila['id'] . "' class='eliminar' title='Eliminar'
              onclick='return confirm(\"¿Estás seguro de que deseas eliminar este documento?\")'>";
        echo "<i class='fa-solid fa-trash'></i>";
        echo"</a>";



    echo "</details>";
    echo"</div>";
}
        $no++;
  
echo"</div>";
    // Se cierra la tabla

}
echo "<br>";
echo "</div>";
?>