<?php
// menu.php

require_once 'conexion.php'; 

function registrarAmbulancia($con) {
    echo "Patente: ";
    $patente = trim(fgets(STDIN));
    echo "Estado (disponible/en uso): ";
    $estado = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla ambulancias
    $stmt = $con->prepare("INSERT INTO ambulancias (patente, estado) VALUES (:patente, :estado)");
    $stmt->execute([
        'patente' => $patente,
        'estado' => $estado
    ]);
    echo "Ambulancia registrada correctamente.\n";
}

function registrarInsumo($con) {
    echo "Nombre del insumo: ";
    $nombre = trim(fgets(STDIN));
    echo "Cantidad: ";
    $cantidad = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla insumos
    $stmt = $con->prepare("INSERT INTO insumos (nombre, cantidad) VALUES (:nombre, :cantidad)");
    $stmt->execute([
        'nombre' => $nombre,
        'cantidad' => $cantidad
    ]);
    echo "Insumo registrado correctamente.\n";
}

function subirDocumento($con) {
    echo "ID del registro asociado (traslado, ambulancia, etc.): ";
    $referencia_id = trim(fgets(STDIN));
    echo "Ruta o nombre del archivo: ";
    $ruta = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla documentos
    $stmt = $con->prepare("INSERT INTO documentos (referencia_id, ruta_archivo) VALUES (:referencia_id, :ruta_archivo)");
    $stmt->execute([
        'referencia_id' => $referencia_id,
        'ruta_archivo' => $ruta
    ]);
    echo "Documento registrado correctamente.\n";
}

// ==== MENÚ PRINCIPAL ====
while (true) {
    echo "\n===== MENÚ DE ADMINISTRACIÓN DE BASE DE DATOS =====\n";
    echo "1) Registrar ambulancia\n";
    echo "2) Registrar insumo\n";
    echo "3) Subir documento\n";
    echo "4) Salir\n";
    echo "Elija una opción: ";

    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case '1':
            registrarAmbulancia($con);
            break;
        case '2':
            registrarInsumo($con);
            break;
        case '3':
            subirDocumento($con);
            break;
        case '4':
            echo "Saliendo del script...\n";
            exit(0);
        default:
            echo "Opción inválida, intente nuevamente.\n";
    }
}