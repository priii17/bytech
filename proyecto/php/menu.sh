<?php
// menu.php

require_once 'conexion.php'; 

function registrarAmbulancia ($con) {

    echo "Seleccione registro: ";
    $matricula = trim(fgets(STDIN));
    echo "modelo : ";
    $modelo = trim(fgets(STDIN));

    // edita en ambulancia en db 
    $stmt = $con->prepare("INSERT INTO ambulancia (matricula, modelo) VALUES (?,?)");
       

    $stmt->bind_param("ss", $matricula, $modelo);

    if ($stmt->execute()) {
        echo " registro correctamente.\n";
    } else {
        echo "Error al registrar: " . $stmt->error . "\n";
    }


    $stmt->close();
}
function registrarInsumo($con) {
    echo "Nombre del insumo: ";
    $nombre = trim(fgets(STDIN));
    echo "descripcion: ";
    $descripcion = trim(fgets(STDIN));

    // edita en la tabla insumos en la db
    $stmt = $con->prepare("INSERT INTO insumos (nombre, descripcion ) VALUES (?,?)");

     $stmt->bind_param("ss", $nombre, $descripcion);

    if ($stmt->execute()) {
        echo " registro correctamente.\n";
    } else {
        echo "Error al registrar: " . $stmt->error . "\n";
    }
}

function subirDocumento($con) {
    echo "nombre:";
    $nombre_documento = trim(fgets(STDIN));
    echo "tipo: ";
    $tipo_documento = trim(fgets(STDIN));

    //edita en la tabla documento en DB
    $stmt = $con->prepare("INSERT INTO documento (nombre_documento, tipo_documento) VALUES (?,? )");
      $stmt->bind_param("ss", $nombre_documento, $tipo_documento);

    if ($stmt->execute()) {
        echo " registro correctamente.\n";
    } else {
        echo "Error al registrar: " . $stmt->error . "\n";
    }
}

// MENÚ PRINCIPAL 


while (true) {
    echo "\n MENÚ DE BD\n" ;
    echo "1) Registrar \n";
    echo "2) registar\n";
    echo "3) registrar \n";
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
