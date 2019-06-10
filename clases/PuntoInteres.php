<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09/03/2019
 * Time: 12:54
 */

require_once('clases/BD.php');
require_once('config/config.php');
header('Content-Type: text/html; charset=utf-8');

class PuntoInteres
{
    private $_conexion = null;

    public function __construct()
    {
        $this->_conexion = new BD();
        BD::singleton(HOST, DATABASE, USER, PASSWORD);
    }

    public function crearPuntoInteres($titulo, $descripcion, $imagen, $telefono, $idUsuario)
    {
        if ($this->comprobarSiExiste($titulo)) {
            return false;
        }
        $result = $this->_conexion->query('INSERT INTO puntos_interes(id,titulo,descripcion,imagen,telefono,id_usuario) 
              VALUES(null,:titulo,:descripcion,:imagen,:telefono,:id_usuario);',
            array(
                ':titulo' => trim($titulo),
                ':descripcion' => $descripcion,
                ':imagen' => $imagen,
                ':telefono' => $telefono,
                ':id_usuario' => $idUsuario

            )
        );

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
    }

    public function comprobarSiExiste($titulo)
    {
        $result = $this->_conexion->query('SELECT * FROM puntos_interes WHERE titulo = :titulo LIMIT 1',
            array(
                ":titulo" => $titulo
            )
        )->fetch();

        if ($result) {
            return true;
        };
        return false;
    }

    public function getUnosCuantosPuntosInteres($inicio, $postPorPagina)
    {
        return $this->_conexion->query('SELECT SQL_CALC_FOUND_ROWS * FROM puntos_interes LIMIT '.$inicio.','.$postPorPagina,
           []
        )->fetchAll();
    }

    public function obtenerNumeroDePuntosInteres()
    {
        return $this->_conexion->query('SELECT FOUND_ROWS() as total', []
        )->fetch()['total'];
    }

    public function getPuntoInteres($id)
    {
        return $this->_conexion->query('SELECT * FROM puntos_interes WHERE id = :id LIMIT 1',
            array(
                ":id" => $id
            )
        )->fetchAll()[0];
    }

    public function getPuntosInteres()
    {
        return $this->_conexion->query('SELECT * FROM puntos_interes', [])->fetchAll();
    }

    public function getId($titulo)
    {
        return $this->_conexion->query('SELECT id FROM puntos_interes WHERE titulo = :titulo LIMIT 1',
            array(
                ":titulo" => $titulo
            )
        )->fetch()['id'];
    }

    public function autenticar($nombre, $psw)
    {
        $result = $this->_conexion->query('SELECT * FROM usuarios WHERE nombre = :nombre',
            array(":nombre" => $nombre)
        );
        $hash = password_verify($psw, $result->fetch()['password']);
        if ($hash) {
            return true;
        }
    }


    public function getIdUsuario($nombre)
    {
        return $this->_conexion->query('SELECT id FROM usuarios WHERE nombre = :nombre;',
            array(":nombre" => $nombre)
        )->fetch()['id'];
    }

    public function getUsuario($nombre)
    {
        return $this->_conexion->query('SELECT nombre FROM usuarios WHERE nombre = :nombre;',
            array(":nombre" => $nombre)
        )->fetch()["nombre"];
    }

    public function getUsuarios()
    {
        return $this->_conexion->query('SELECT * FROM usuarios',
            array()
        )->fetchAll();
    }

    public function getImages()
    {
        return $this->_conexion->query('SELECT imagen FROM puntos_interes',
            array()
        )->fetchAll();
    }

}