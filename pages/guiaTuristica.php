<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 09/03/2019
 * Time: 18:34
 */
require 'utiles/funciones.php';
require_once "clases/Recorrido.php";
require_once "clases/GuiaTuristica.php";
require_once "clases/Usuarios.php";
require "ftpd/fpdf/fpdf.php";

$Guia = new GuiaTuristica();
$Usuarios = new Usuarios();
$Recorrido = new Recorrido();
$id = $_GET['guiaTuristica'];
$guia = $Guia->getGuia($id)[0];
$puntosDeInteres = $Guia->getPuntosInteres($guia["id"]);
$recorridos = $Recorrido->getRecorridos($guia["id"]);
for($i=0; $i<count($recorridos);$i++){
    if(isset($_POST['Descargar_'.$i])){
        //echo $recorridos[$i]['titulo'];
        $_SESSION['tituloRecorrido']=$recorridos[$i]['titulo'];
        $_SESSION['puntosInteres'] = $Recorrido->getPuntosInteres($recorridos[$i]['id']);

        header("Location: descargaRecorridos.php");
    }
}
//echo $_GET['guiaTuristica']
//http://localhost/xamppPHP/1.ServidorClase/3.Servidor/ProyectoGuias/index.php?page=guiaTuristica&guiaTuristica=1
?>

<div id="cuerpoElemento">
    <h1 id="titulo_ptoInteres"><?php echo $guia["Titulo"] ?></h1>
    <h3>Creado por : <?php echo ponerPrimeraLetraMayuscula($Usuarios->getNombre($guia["id_usuario"])) ?></h3>
    <section id="cuerpoPuntoInteres">

        <div id="Muestra_descripcion_ptoInteres">
            <div class="contenido_descripcion_ptoInteres">
                <h3>Descripción</h3>
                <?php echo $guia["descripcion"] ?>
            </div>
            <div class="contenedorRecorridos">
                <h1>Recorridos: </h1>
                <ul>
                    <?php
                    $h=0;
                    foreach ($recorridos as $recorrido) { ?>
                        <li>
                            <div style="display: flex;">
                            <h3><?php echo $recorrido["titulo"] ?> </h3>
                                <form action="" method="post" style="margin-left: 10px;">
                                    <label for="Descargar_<?php echo $h ?>"><i class="fas fa-download"></i></label>
                                    <input style="display: none;" type="submit" value="Descargar" name="Descargar_<?php echo $h ?>" id="Descargar_<?php echo $h ?>">
                                </form>
                            </div>
                            <?php $ptosIntDelRecorrido = $Recorrido->getPuntosInteres($recorrido["id"]); ?>
                            <ul>
                                <?php foreach ($ptosIntDelRecorrido as $ptoIntDelRecorrido) { ?>
                                    <li><?php echo $ptoIntDelRecorrido["titulo"] ?></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php
                    $h++;
                    } ?>
                </ul>
            </div>
            <div class="contenedorPuntosInteres">
                <h1>Puntos De Interés de la guía: </h1>
                <ul>
                    <?php foreach ($puntosDeInteres as $puntoDeInteres) { ?>
                        <li><h3><?php echo $puntoDeInteres["titulo"] ?></h3></li>
                    <?php } ?>
                </ul>
            </div>
            <div id="footerPuntoInteres">
                <span>Guía creada:</span>
                <?php echo $guia["fechaDeCreacion"] ?>
            </div>
        </div>

    </section>
</div>

