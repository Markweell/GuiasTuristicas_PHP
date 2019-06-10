<?php
/**
 * @User: Guillermo Boquizo Sánchez
 * @File: Config.php
 * @Date: 11/12/18
 * @Description: Clase encargada de la gestión de la configuración del sitio.
 * @license http://opensource.org/licenses/gpl-license.php  GNU Public License
 */
require_once('BD.php');
require_once('config/config.php');

class Config
{

    private $conexion = null;

    public function __construct()
    {
        $this->conexion = new BD();
        BD::singleton(HOST, DATABASE, USER, PASSWORD);
    }
}