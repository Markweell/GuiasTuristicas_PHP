<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 25/02/2019
 * Time: 20:03
 */
class BaseDeDatos{
    function conectar_base_datos(){
        return new PDO('mysql:host=localhost;dbname=proyectoguiasturisticas', 'root', '');
    }
}
?>