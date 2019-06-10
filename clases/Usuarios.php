<?php
/**
 * @User: Guillermo Boquizo Sánchez
 * @File: Usuarios.php
 * Date: 11/12/18
 * @Description: Clase encargada de la gestión de usuarios.
 * @license http://opensource.org/licenses/gpl-license.php  GNU Public License
 */

require_once('clases/BD.php');
require_once('config/config.php');

class Usuarios
{
    private $_conexion = null;

    public function __construct()
    {
        $this->_conexion = new BD();
        BD::singleton(HOST, DATABASE, USER, PASSWORD);
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

    public function crearUsuario($nombre, $password)
    {
        $result = $this->_conexion->query('INSERT INTO usuarios(nombre,password,tipo) VALUES(:nombre,:psw,:tipo);',
            array(
                ":nombre" => $nombre,
                ":psw" => password_hash($password, PASSWORD_DEFAULT),
                ":tipo" => 'admin'
            )
        );

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
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
    public function getNombre($id)
    {
        return $this->_conexion->query('SELECT nombre FROM usuarios WHERE id = :id;',
            array(":id" => $id)
        )->fetch()["nombre"];
    }

    public function getUsuarios()
    {
        return $this->_conexion->query('SELECT * FROM usuarios',
            array()
        )->fetchAll();
    }

    public function getUsuariosTipo($id)
    {
        return $this->_conexion->query('SELECT tipo FROM usuarios where id = :id;',
            array(":id" => $id)
        )->fetch()["tipo"];
    }


    public function comprobarUsuariosTipo($nombre)
    {
        return $this->_conexion->query('SELECT tipo FROM usuarios where nombre = :nombre;',
            array(":nombre" => $nombre)
        )->fetch();
    }

    /*public function getAlumnosNoValidados()
    {
        return $this->_conexion->query('SELECT id,nombre FROM usuarios WHERE activo = 0',
            array()
        )->fetchAll();
    }
    public function getAlumnosValidados()
    {
        return $this->_conexion->query('SELECT * FROM usuarios WHERE activo = 1 and  not (perfil =:Profesor);',
            array(":Profesor" => "Profesor")
        )->fetchAll();
    }

    public function validarUsuario($id)
    {
        $result = $this->_conexion->query('UPDATE usuarios SET activo = 1 WHERE id = :id;',
            array(":id" => $id));

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
    }

    public function validarTodos()
    {
        $result = $this->_conexion->query('UPDATE usuarios SET activo = 1 WHERE activo = 0;',
            array());

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
    }

    public function desvalidarTodos()
    {
        $result = $this->_conexion->query('UPDATE usuarios SET activo = 0 WHERE activo = 1 and  not (perfil =:Profesor);',
            array(":Profesor" => "Profesor"));

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
    }

    public function desactivarUsuarios($id)
    {
        $result = $this->_conexion->query('UPDATE usuarios SET activo = 0 WHERE id = :id;',
            array(":id" => $id));

        return $result->errorCode() == '00000';//comprobar que no se haya producido ningun error
    }

    public function crearDirectorio($id)
    {
        if (!mkdir("./uploads/usuario" . $id, 0777)) {
            echo "ERROR";
        }
    }*/
}