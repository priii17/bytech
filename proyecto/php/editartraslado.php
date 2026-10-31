<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "conexion.php";

if (!isset($_GET["id"])) {
    exit("No se recibió el ID");
}

$id = (int) $_GET["id"];

$sentencia = $con->prepare("SELECT * FROM registro_traslado WHERE id = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$t = $sentencia->get_result()->fetch_assoc();
$sentencia->close();

if (!$t) {
    exit("No hay resultados para ese ID");
}

// Si una consulta falla  devuelve la  lista vacía en vez de dar error en la pagina
function cargar($con, $sql) {
    try {
        $r = $con->query($sql);
        return $r ? $r->fetch_all(MYSQLI_ASSOC) : [];
    } catch (Throwable $e) {
        return [];
    }
}

$listaFuncionarios = cargar($con, "
    SELECT f.id, p.nombre
    FROM funcionario f
    INNER JOIN personas p ON p.id = f.id
    ORDER BY p.nombre
");

$listaAmbulancias = cargar($con, "SELECT id, modelo, matricula FROM ambulancia ORDER BY modelo");


$listaInsumos       = cargar($con, "SELECT id, nombre FROM insumos ORDER BY nombre");
$listaEquipamiento  = cargar($con, "SELECT id, nombre FROM equipamiento ORDER BY nombre");

function h($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

function hora($v) {
    return $v ? substr($v, 0, 5) : '';
}

function sel($a, $b) {
    return ((string) $a === (string) $b) ? 'selected' : '';
}

$departamentos = [
    "Montevideo", "Canelones", "Rocha", "Florida", "Treinta y Tres", "Cerro Largo",
    "Paysandú", "Salto", "Artigas", "Río Negro", "Tacuarembó", "Flores",
    "Lavalleja", "Maldonado", "Colonia", "Durazno", "Rivera", "San José", "Soriano"
];


$bloques = [
    'insumos'      => ['Insumo',       'id_insumo',       $listaInsumos],
    'equipamiento' => ['Equipamiento', 'id_equipamiento', $listaEquipamiento],
];


$campos = [
    ['text', 'descripcionorigen',   'Descripción de origen'],
    ['date', 'fecha_origen',        'Fecha de origen'],
    ['time', 'hora_origen',         'Hora de origen'],
    ['text', 'descripcion_destino', 'Descripción de destino'],
    ['date', 'fecha_destino',       'Fecha de destino'],
    ['time', 'hora_destino',        'Hora de destino'],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar traslado</title>
    <link rel="stylesheet" href="../css/FuncionarioPC.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>
<body class="body2">

    <form class="Contenedor3" id="editartraslado" action="actualizar_traslado.php" method="POST">

        <p class="signin">
            <a href="../traslado/Traslado.html">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </p>

        <p class="title">Actualizar traslado</p>

        <input type="hidden" name="id" value="<?= (int) $t['id'] ?>">

  
        <div class="campo">
            <label for="Trasladar">Elemento</label>
            <br>
            <select id="Trasladar" name="elemento" required>
                <option value="">-- Seleccione --</option>
                <option value="persona"      <?= sel($t['elemento'], 'persona') ?>>Paciente</option>
                <option value="equipamiento" <?= sel($t['elemento'], 'equipamiento') ?>>Equipamiento</option>
                <option value="insumos"      <?= sel($t['elemento'], 'insumos') ?>>Insumos</option>
            </select>
        </div>

        <br>

        <?php foreach ($bloques as $clave => [$titulo, $nombre, $lista]): ?>
            <div class="campo" id="campo-<?= $clave ?>" style="display:none;">
                <label for="<?= $nombre ?>"><?= $titulo ?></label>
                <br>
                <select id="<?= $nombre ?>" name="<?= $nombre ?>">
                    <option value="">-- Elegir --</option>
                    <?php foreach ($lista as $x): ?>
                        <option value="<?= (int) $x['id'] ?>" <?= sel($t[$nombre] ?? '', $x['id']) ?>>
                            <?= h($x['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endforeach; ?>

        <label>
                    <span>Conductor</span>
            <select class="input" name="id_conductor" required>
                <?php foreach ($listaFuncionarios as $f): ?>
                    <option value="<?= (int) $f['id'] ?>" <?= sel($t['id_conductor'], $f['id']) ?>>
                        <?= h($f['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
    
        </label>

        <label>
                 <span>Acompañante</span>
            <select class="input" name="id_acompaniante">
                <option value="">Sin acompañante</option>
                <?php foreach ($listaFuncionarios as $f): ?>
                    <option value="<?= (int) $f['id'] ?>" <?= sel($t['id_acompaniante'], $f['id']) ?>>
                        <?= h($f['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
    
        </label>

        <label>
                  <span>Ambulancia</span>
            <select class="input" name="id_ambulancia" required>
                <?php foreach ($listaAmbulancias as $a): ?>
                    <option value="<?= (int) $a['id'] ?>" <?= sel($t['id_ambulancia'], $a['id']) ?>>
                        <?= h($a['modelo']) ?> - <?= h($a['matricula']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
      
        </label>

        <p>Origen</p>
        <div class="campo">
            <select id="departamento_origen" name="departamento_origen" required>
                <option value="">-- Seleccione --</option>
                <?php foreach ($departamentos as $d): ?>
                    <option value="<?= h($d) ?>" <?= sel($t['departamento_origen'] ?? '', $d) ?>><?= h($d) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php foreach ($campos as [$tipo, $nombre, $texto]): ?>
            <label>
                <input class="input" type="<?= $tipo ?>" name="<?= $nombre ?>" placeholder=" " required
                       value="<?= h($tipo == 'time' ? hora($t[$nombre]) : $t[$nombre]) ?>">
                <span><?= $texto ?></span>
            </label>
            <br>
        <?php endforeach; ?>

        <div id="visualizar" style="height:300px;"></div>
        <br>
        <button type="button" id="trazar_ruta">Trazar ruta</button>
        <br>
        <button class="submit" type="submit">Guardar cambios</button>

    </form>

    <script>
    // ---- Mostrar solo el bloque del elemento elegido ----
    const selElemento = document.getElementById('Trasladar');
    const bloques = {
        persona:      document.getElementById('campo-persona'),
        insumos:      document.getElementById('campo-insumos'),
        equipamiento: document.getElementById('campo-equipamiento')
    };

    function mostrarBloque() {
        const elegido = selElemento.value;
        for (const clave in bloques) {
            const visible = clave === elegido;
            bloques[clave].style.display = visible ? 'block' : 'none';

    
            const sel = bloques[clave].querySelector('select');
            sel.disabled = !visible;
        }
    }

    selElemento.addEventListener('change', mostrarBloque);
    mostrarBloque(); 


    const mapa = L.map('visualizar').setView([-34.9011, -56.1645], 7); 
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap'
    }).addTo(mapa);

    let capa = L.layerGroup().addTo(mapa);

    async function geocodificar(texto) {
        const url = 'https://nominatim.openstreetmap.org/search?format=json&limit=1&q=' +
                    encodeURIComponent(texto + ', Uruguay');
        const r = await fetch(url);
        const datos = await r.json();
        if (!datos.length) return null;
        return [parseFloat(datos[0].lat), parseFloat(datos[0].lon)];
    }

    document.getElementById('trazar_ruta').addEventListener('click', async () => {
        const f = document.getElementById('editartraslado');
        const dep     = f.departamento_origen.value;
        const origen  = f.descripcionorigen.value + (dep ? ', ' + dep : '');
        const destino = f.descripcion_destino.value;

        if (!f.descripcionorigen.value || !destino) {
            alert('Completá la descripción de origen y de destino.');
            return;
        }

        const a = await geocodificar(origen);
        const b = await geocodificar(destino);
        if (!a || !b) {
            alert('No se pudo ubicar alguna de las direcciones.');
            return;
        }

        capa.clearLayers();
        L.marker(a).addTo(capa).bindPopup('Origen');
        L.marker(b).addTo(capa).bindPopup('Destino');
        L.polyline([a, b], { color: 'blue' }).addTo(capa);
        mapa.fitBounds([a, b], { padding: [30, 30] });
    });
    </script>

</body>
</html>