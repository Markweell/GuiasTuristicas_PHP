<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 03/03/2019
 * Time: 15:10
 */
require 'utiles/funciones.php';

session_start();

?>

<div>
    <h1>Guías Turísticas</h1>

    <ul>
        <li style="color:white;">
            Hola
        </li>
        <?php if (isset($_SESSION['usuario'])): ?>
            <li style="color:white;">
                <?php echo ponerPrimeraLetraMayuscula($_SESSION['usuario']) ?>
            </li>
        <?php else: ?>
        <li style="color:white;">
             Visitante
        </li>
        <?php endif; ?>
    </ul>

</div>

