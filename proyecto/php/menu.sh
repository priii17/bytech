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

function eliminarAmbulancia($con){

    echo "Matricula de la ambulancia que desea eliminar:";
    $matricula=trim(fgets(STDIN));

    $stmt= $con->prepare("DELETE FROM ambulancia WHERE matricula=?");
    $stmt->bind_param("s",$matricula);

    if ($stmt->execute()) {
        echo "Ambulancia eliminada correctamente.\n";
    } else {
        echo "Error al eliminar: " . $stmt->error . "\n";
    }

}

function eliminarInsumo($con){

    echo "Nombre del insumo que desea eliminar:";
    $nombre=trim(fgets(STDIN));

    $stmt= $con->prepare("DELETE FROM insumos WHERE nombre=?");
    $stmt->bind_param("s",$nombre);

    if ($stmt->execute()) {
        echo "Insumo eliminado correctamente.\n";
    } else {
        echo "Error al eliminar: " . $stmt->error . "\n";
    }

}

function eliminarDocumento($con){

    echo "Nombre del documento que desea eliminar:";
    $nombre=trim(fgets(STDIN));

    $stmt= $con->prepare("DELETE FROM documento WHERE nombre_documento=?");
    $stmt->bind_param("s",$nombre);

    if ($stmt->execute()) {
        echo "Documento eliminado correctamente.\n";
    } else {
        echo "Error al eliminar: " . $stmt->error . "\n";
    }

}


// MENÚ PRINCIPAL 


while (true) {
    echo "\n MENÚ DE BD\n" ;
    echo "1) Registrar \n";
    echo "2) Eliminar\n";
    echo "3) Salir\n";
    echo "Elija una opción: ";

    $opcion = trim(fgets(STDIN));

    switch ($opcion) {

        case '1':
        echo "\n ¿Que desea registrar?\n" ;
        echo "1) Ambulancia \n";
        echo "2) Insumo\n";
        echo "3) Salir\n";
        echo "Elija una opción: ";

        $registrar= trim(fgets(STDIN));

        switch($registrar){

            case '1':
            registrarAmbulancia($con);
            break;

            case '2':
            registrarInsumo($con);
            break;

            case'3':
            subirDocumento($con);
            break;

            default:
            echo "Opción inválida, intente nuevamente.\n";

        }
        break;

        
        case '2':
        echo "\n ¿Que desea eliminar?\n" ;
        echo "1) Ambulancia\n";
        echo "2) Insumo\n";
        echo "3) Documento\n";
        echo "4) Salir\n";
        echo "Elija una opción: ";
        
        $eliminar= trim(fgets(STDIN));

        switch($eliminar){
          case '1':
            eliminarAmbulancia($con);
            break;

            case '2':
            eliminarInsumo($con);
            break;

            case'3':
            eliminarDocumento($con);
            break;

            default:
            echo "Opción inválida, intente nuevamente.\n";
        }
        break;

        case '4':
            echo "Saliendo del script...\n";
            exit(0);
        default:
            echo "Opción inválida, intente nuevamente.\n";

    }
    
}
