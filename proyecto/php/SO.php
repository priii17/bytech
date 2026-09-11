<?php
// menu.php

require_once 'conexion.php'; 

function registrarAmbulancia($con) {
    echo "Matricula: ";
    $Matricula = trim(fgets(STDIN));
    echo "modelo : ";
    $modelo = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla ambulancias
    $stmt = $con->prepare("INSERT INTO ambulancia (Matricula, modelo) VALUES (:Matricula, :modelo)");
    $stmt->execute([
        'Matricula' => $Matricula,
        'modelo' => $modelo
    ]);
    echo " registro correctamente.\n";
}

function registrarInsumo($con) {
    echo "Nombre del insumo: ";
    $nombre = trim(fgets(STDIN));
    echo "descripción: ";
    $descripcion = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla insumos
    $stmt = $con->prepare("INSERT INTO insumos (nombre,descripcion ) VALUES (:nombre, :descripcion)");
    $stmt->execute([
        'nombre' => $nombre,
        'descrpcion' => $descripcion
    ]);
    echo "registro correctamente.\n";
}

function subirDocumento($con) {
    echo "nombre";
    $nombre = trim(fgets(STDIN));
    echo "tipo: ";
    $tipo = trim(fgets(STDIN));

    // AJUSTAR: nombres de columnas reales de tu tabla documentos
    $stmt = $con->prepare("INSERT INTO documento (nombre, tipo) VALUES (: :ruta_archivo)");
    $stmt->execute([
        'referencia_id' => $referencia_id,
        'ruta_archivo' => $ruta
    ]);
    echo "Documento registrado correctamente.\n";
}

// ==== MENÚ PRINCIPAL ====


while (true) {
    echo "\n===== MENÚ DE ADMINISTRACIÓN DE BASE DE DATOS =====\n" ;
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
