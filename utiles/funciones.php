<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 25/02/2019
 * Time: 18:59
 */

function ponerPrimeraLetraMayuscula($string){
    return strtoupper(substr ($string,0,1)).substr ($string,1);
}
function obtenerExtensionArchivo($fileName){
    $array = explode ( ".", $fileName);
    return end($array);
}
function devuelveCienCaracteres($texto){
    echo substr($texto,0 ,500);
}
function borrarImagenesQueNoSeUsan(){
    require_once "clases/PuntoInteres.php";
    $PuntoInteres=new PuntoInteres();
    $fotosUsadas=[];
    foreach ($PuntoInteres->getImages() as $imagen){
        $fotosUsadas [explode("/",$imagen['imagen'])[3]]="1";
    }
    $i=0;
    $j=0;
    $archivosCarpeta=scandir("img/imagenesPuntosInteres/");
    foreach ($archivosCarpeta as $value) {
        if($value!="."&&$value!="..")
            if(!isset($fotosUsadas [$value])){
                echo $value."NO SE USA Y SE DEBE ELIMINAR! <br>";
                $j++;
                //unlink ("img/imagenesPuntosInteres/".$value);//Cuidado al descomentar esta linea estas borrando ficheros
            }else{
                echo $value.": Sí se usa <br>";
                $i++;
            }
    }
    echo "Hay: ".$i." imagenes que se usan en la base de datos y: ".$j." que no se usan. Si estas de acuerdo, descomenta la linea 34 de funciones.php";
}

?>