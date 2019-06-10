<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/03/2019
 * Time: 18:59
 */
if(!isset($_GET['textoInput']))
    return;

require "BaseDeDatos.php";
    try {
        $conexion = BaseDeDatos::conectar_base_datos();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $statement = $conexion->prepare('SELECT * FROM guias where lower(guias.Titulo LIKE  \'%\'  :valorBusqueda  \'%\');');
    $statement->execute([":valorBusqueda"=>$_GET['textoInput']]);
    echo json_encode($statement->fetchAll());
?>