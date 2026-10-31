<?php
require_once "conexion.php";

//llama las variables de documento
$resultado = $con->query("SELECT * FROM documento");

echo "<div class='tarjeta'>";

echo "<div class='encabezado'>";

echo "<div class='info'>";

echo "<h2 class='titulo'>Documentos Subidos</h2>";
echo "<p class='subtitulo'>Gestiona los documentos subidos.</p>";
echo "</div>";

echo "<a href='subirdoc.html' class='boton'>";
echo "<i class='fa-solid fa-plus'></i> Subir";
echo "</a>";
echo "</div>";


if ($resultado->num_rows == 0) {
    echo "<p>No hay documentos cargados.</p>";
} else{

    // Se abre la tabla y se escriben los títulos UNA sola vez
    echo "<table class='tabla-docs'>";
    echo "<tr>";
    echo "<th>N° Documentos</th>";
    echo "<th>Nombre</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    $no=1; // Variable para llevar el conteo de los documentos
  
    // fetch_assoc() devuelve una fila como array asociativo 
  //  y avanza automáticamente al siguiente documento en cada vuelta del while.
// Cuando ya no quedan filas, fetch_assoc() devuelve null y el while corta solo

while ($fila = $resultado->fetch_assoc()) {
  
   echo "<tr>";
        echo "<td>" . $no . "</td>";
      //recibe los datos del registro 
        echo "<td>" . htmlspecialchars($fila['nombre_documento']) . "</td>";
      

        echo "<td>";
        echo "<button class='ver' data-url='" . htmlspecialchars($fila['qr'], ENT_QUOTES) . "' title='Ver QR'>";
        echo "<i class='fa-solid fa-eye'></i>";
        echo "</button> ";

        echo "<a href='../php/editar_documento.php?id=" . $fila['id'] . "' class='editar' title='Editar'>";
        echo "<i class='fa-solid fa-pen-to-square'></i>";
        echo "</a> ";

        echo "<a href='../php/eliminar_documento.php?id=" . $fila['id'] . "' class='eliminar' title='Eliminar'
              onclick='return confirm(\"¿Estás seguro de que deseas eliminar este documento?\")'>";
        echo "<i class='fa-solid fa-trash'></i>";
        echo "</a>";
        echo "</td>";

        echo "</tr>";
        $no++;
    }

    // Se cierra la tabla
    echo "</table>";
}
  
echo "</div>";
?>