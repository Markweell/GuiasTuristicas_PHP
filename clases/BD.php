<?php

/**
 */
class BD
{
    private static $conexion = NULL;

    /**
     * Método singleton para comprobar si hay una conexión abierta no volver a crearla.
     * @param $ipBBDD
     * @param $nombreBBDD
     * @param $usuario
     * @param $contrasena
     * @return mixed
     */
    static public function singleton($ipBBBD, $nombreBBDD, $usuario, $contrasena)
    {
        try {
            if (self::$conexion == NULL) {
                self::$conexion = new PDO('mysql:host=' . $ipBBBD . ';dbname=' . $nombreBBDD . '', $usuario, $contrasena);
                self::$conexion->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND ,"SET NAMES 'utf8'");
                self::$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
            return self::$conexion;
        } catch (PDOException $e) {
            print "Error al conectar con la BBDD, estás en el catch";
            print "<p>Error: " . $e->getMessage() . "</p>\n";
        }
    }
    /**
     * Insertar query en bbdd
     * @param $sql
     * @param $arrayParametros
     * @return mixed
     */
    public function query($sql, $arrayParametros)
    {
        $consulta = $sql;
        $result = self::$conexion->prepare($consulta);
        $result->execute($arrayParametros);

        return $result;
    }
}
