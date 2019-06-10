<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/2019
 * Time: 18:31
 */
require "BaseDeDatos.php";

function getPuntosInteres(){
    $opcionesSelect= "{";
    try {
        $conexion = BaseDeDatos::conectar_base_datos();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $statement = $conexion->prepare('SELECT * FROM puntos_interes');
    $statement->execute();
    foreach ($statement as $row) {
        $opcionesSelect.="\"".$row['id']."\":\"".$row['titulo']."\",";
    }
    $opcionesSelect = substr ($opcionesSelect, 0,strlen ($opcionesSelect)-1);
    $opcionesSelect.= "}";
    return $opcionesSelect;
}

echo getPuntosInteres();
?>