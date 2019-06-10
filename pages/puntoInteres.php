<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/03/2019
 * Time: 21:52
 */


require 'utiles/funciones.php';
require_once "clases/Usuarios.php";
require_once "clases/PuntoInteres.php";

$id = $_GET['ptoInteres'];
$PuntoInteres = new PuntoInteres();
$Usuarios = new Usuarios();
$punto_interes = $PuntoInteres->getPuntoInteres($id);
$creador = $Usuarios->getNombre($punto_interes["id_usuario"]);
?>

<div id="cuerpoElemento">
    <h1 id="titulo_ptoInteres"><?php echo $punto_interes["titulo"] ?></h1>
    <h3>Creado por : <?php echo ponerPrimeraLetraMayuscula($creador) ?></h3>
    <section id="cuerpoPuntoInteres">
        <div id="Muestra_Imagen">
            <img src="<?php echo $punto_interes["imagen"] ?>" alt="ImagenPunto de interés">
        </div>
        <div id="Muestra_descripcion_ptoInteres">
            <div class="contenido_descripcion_ptoInteres">
                <h3>Descripción</h3>
                <?php echo $punto_interes["descripcion"] ?>
            </div>
            <div id="footerPuntoInteres">
                <span>Teléfono de contacto:</span>
                <?php echo $punto_interes["telefono"] ?>
            </div>
        </div>

    </section>
</div>

