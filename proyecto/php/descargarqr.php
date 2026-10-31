<?php
$carpeta = __DIR__ . '/../archivos/';
$nombre  = basename($_GET['archivo'] ?? '');
$ruta    = $carpeta . $nombre;

if ($nombre === '' || !is_file($ruta)) {
    http_response_code(404);
    echo "Recibido: [" . htmlspecialchars($_GET['archivo'] ?? '') . "]<br>";
    echo "Busco en: " . htmlspecialchars(realpath($carpeta) ?: $carpeta . ' (la carpeta no existe)') . "<br>";
    echo "Archivos en la carpeta: ";
    print_r(is_dir($carpeta) ? scandir($carpeta) : 'no existe');
    exit;
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $nombre . '"');
header('Content-Length: ' . filesize($ruta));
readfile($ruta);
?>