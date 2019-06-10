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
$statement = $conexion->prepare('SELECT * FROM puntos_interes where lower(puntos_interes.titulo LIKE  \'%\'  :valorBusqueda  \'%\');');
$statement->execute([":valorBusqueda"=>$_GET['textoInput']]);
echo json_encode($statement->fetchAll());
?>
