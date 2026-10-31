<?php
if ($stmt->execute()) {

    $id_traslado = $con->insert_id; // id del traslado recién guardado

    $lat  = $_POST["lat"]  ?? "";
    $lng = $_POST["lng"]  ?? "";
   

    if (is_numeric($lat) && is_numeric($lng))  {

        $lat  = (float) $lat;
        $lng  = (float) $lng;
        

        $stmtCoord = $con->prepare(
            "UPDATE registro_traslado
             SET lat = ?, lng = ?
             WHERE id = ?"
        );
        $stmtCoord->bind_param("ddddi", $lat_origen, $lng_origen, $lat_destino, $lng_destino, $id_traslado);
        $stmtCoord->execute();
        $stmtCoord->close();
    }

    header("Location: ../traslado/Traslado.html");
    exit;
}
?>