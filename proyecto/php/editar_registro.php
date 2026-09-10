<?php
include_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = $_GET["id"];

$sentencia = $con->prepare("
    SELECT
        id,
        elemento,
        id_conductor,
        nombre_conductor,
        id_acompaniante,
        nombre_acompaniante,
        id_ambulancia,
        modelo,
        matricula_ambulancia,
        descripcionorigen,
        fecha_origen,
        hora_origen,
        descripcion_destino,
        fecha_destino,
        hora_destino,
        ruta,
        descripcionruta
    FROM registro_traslado
    WHERE id = ?
");

$sentencia->bind_param("i", $id);
$sentencia->execute();

$resultado = $sentencia->get_result();

$traslado = $resultado->fetch_assoc();

if (!$traslado) {
    exit("No hay resultados para ese ID");
}
?>

 <body class="body2">
<h1>Actualizar traslado</h1>

<form action="./editar_registro.php" method="POST" class="contenedor3">
     <link rel="stylesheet" href="../css/FuncionarioPC.css">
 
    <!-- ID -->
    <input type="hidden" name="id"
           value="<?php echo $traslado['id']; ?>">


    <!-- ELEMENTO -->

    
    <p>Elemento a trasladar:</p>

    <select name="elemento" required>

        <option value="persona"
        <?php if ($traslado['elemento'] == 'persona') echo 'selected'; ?>>
            Paciente
        </option>

        <option value="muestra"
        <?php if ($traslado['elemento'] == 'muestra') echo 'selected'; ?>>
            Muestra
        </option>

        <option value="equipamiento"
        <?php if ($traslado['elemento'] == 'equipamiento') echo 'selected'; ?>>
            Equipamiento
        </option>

        <option value="insumos"
        <?php if ($traslado['elemento'] == 'insumos') echo 'selected'; ?>>
            Insumos
        </option>

    </select>

    <br><br>


    <!-- CONDUCTOR -->

    <p>Conductor:</p>

    <input type="text"
           name="id_conductor"
           value="<?php echo $traslado['id_conductor']; ?>"
           placeholder="ID del conductor"
           required>

    <br><br>

    <input type="text"
           name="nombre_conductor"
           value="<?php echo $traslado['nombre_conductor']; ?>"
           placeholder="Nombre del conductor"
           required>

    <br><br>


    <!-- ACOMPAÑANTE -->

    <p>Acompañante:</p>

    <input type="text"
           name="id_acompaniante"
           value="<?php echo $traslado['id_acompaniante']; ?>"
           placeholder="ID del acompañante"
           required>

    <br><br>

    <input type="text"
           name="nombre_acompaniante"
           value="<?php echo $traslado['nombre_acompaniante']; ?>"
           placeholder="Nombre del acompañante"
           required>

    <br><br>


    <!-- AMBULANCIA -->

    <p>Ambulancia:</p>

    <input type="text"
           name="id_ambulancia"
           value="<?php echo $traslado['id_ambulancia']; ?>"
           placeholder="ID de ambulancia"
           required>

    <br><br>

    <input type="text"
           name="matricula_ambulancia"
           value="<?php echo $traslado['matricula_ambulancia']; ?>"
           placeholder="Matrícula"
           required>

    <br><br>

    <input type="text"
           name="modelo"
           value="<?php echo $traslado['modelo']; ?>"
           placeholder="Modelo"
           required>

    <br><br>


    <!-- ORIGEN -->

    <p>Origen:</p>

    <input type="date"
           name="fecha_origen"
           value="<?php echo $traslado['fecha_origen']; ?>"
           required>

    <br><br>

    <input type="time"
           name="hora_origen"
           value="<?php echo $traslado['hora_origen']; ?>"
           required>

    <br><br>

    <input type="text"
           name="descripcionorigen"
           value="<?php echo $traslado['descripcionorigen']; ?>"
           placeholder="Descripción del origen"
           required>

    <br><br>


    <!-- DESTINO -->

    <p>Destino:</p>

    <input type="date"
           name="fecha_destino"
           value="<?php echo $traslado['fecha_destino']; ?>"
           required>

    <br><br>

    <input type="time"
           name="hora_destino"
           value="<?php echo $traslado['hora_destino']; ?>"
           required>

    <br><br>

    <input type="text"
           name="descripcion_destino"
           value="<?php echo $traslado['descripcion_destino']; ?>"
           placeholder="Descripción del destino"
           required>

    <br><br>


    <!-- RUTA -->

    <p>Ruta:</p>

    <select name="ruta" required>

        <option value="Urbano"
        <?php if ($traslado['ruta'] == 'Urbano') echo 'selected'; ?>>
            Urbano
        </option>

        <option value="Carretera"
        <?php if ($traslado['ruta'] == 'Carretera') echo 'selected'; ?>>
            Carretera
        </option>

        <option value="Internacional"
        <?php if ($traslado['ruta'] == 'Internacional') echo 'selected'; ?>>
            Internacional
        </option>

    </select>

    <br><br>

    <input type="text"
           name="descripcionruta"
           value="<?php echo $traslado['descripcionruta']; ?>"
           placeholder="Descripción de la ruta">

    <br><br>


    <!-- BOTONES -->

    <button type="submit">
        Guardar cambios
    </button>

    <a href="../traslado/registrosrealizados.php">
        Volver
    </a>

</form>
 </body>