<?php
require_once "conexion.php";

$resultado = $con->query("SELECT * FROM encuesta");

echo "<div class='tarjeta-encuesta'>";

echo "<div class='encabezado'>";

echo "<div class='info'>";
echo "<h2 class='titulo'>Encuestas disponibles</h2>";
echo "<p class='subtitulo'>Gestiona las encuestas ingresadas.</p>";
echo "</div>";


echo "<a href='crear_encuestas.html' class='boton'>";
echo "<i class='fa-solid fa-plus'></i> Subir";
echo "</a>";
echo "</div>";

if ($resultado->num_rows == 0) {
    echo "<p>No hay encuestas cargadas.</p>";
} else {
    
    echo "<table class='tabla-encuestas'>";
    echo "<tr>";
    echo "<th>N°</th>";
    echo "<th>Título</th>";
    echo "<th>Descripción</th>";
    echo "<th>N° preguntas</th>";
    echo "<th>Acciones</th>";
    echo "</tr>";

    $no = 1;

    while ($fila = $resultado->fetch_assoc()) {
        $preguntas = json_decode($fila['preguntas'] ?? '[]', true) ?: [];
        $idFila = 'preg' . $no;

        echo "<tr>";
        echo "<td>" . $no . "</td>";
        echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['descripcion'] ?? '') . "</td>";
        echo "<td>" . count($preguntas) . "</td>";

        echo "<td>";
        echo "<button type='button' class='ver' title='Ver preguntas'
              onclick=\"var r=document.getElementById('" . $idFila . "'); r.hidden=!r.hidden;\">";
        echo "<i class='fa-solid fa-eye'></i>";
        echo "</button> ";

        echo "<a href='../php/eliminar_encuesta.php?id=" . (int)$fila['id'] . "' class='eliminar' title='Eliminar'
              onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta encuesta?\")'>";
        echo "<i class='fa-solid fa-trash'></i>";
        echo "</a>";
        echo "</td>";
        echo "</tr>";

        // culta las preguntas
        echo "<tr id='" . $idFila . "' hidden>";
        echo "<td colspan='5'><ol>";
        foreach ($preguntas as $p) {
            $texto = htmlspecialchars($p['texto'] ?? '');
            $tipo = htmlspecialchars($p['tipo'] ?? '');
            echo "<li>" . $texto . " <small>(" . $tipo . ")</small>";
            if (!empty($p['opciones'])) {
                echo "<br><small>Opciones: " . htmlspecialchars(implode(', ', $p['opciones'])) . "</small>";
            }
            echo "</li>";
        }
        echo "</ol></td>";
        echo "</tr>";

        $no++;
    }

    echo "</table>";
}

echo "</div>";
?>