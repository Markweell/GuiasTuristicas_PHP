<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 10/03/2019
 * Time: 10:10
 */


require_once "clases/PuntoInteres.php";
require 'utiles/funciones.php';
require "utiles/BaseDeDatos.php";

$PuntoInteres = new PuntoInteres();
$statement = $PuntoInteres->getPuntosInteres();

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$postPorPagina = 5;
$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;

$statement = $PuntoInteres->getUnosCuantosPuntosInteres($inicio,$postPorPagina);

if(!$statement){
    header('Location: index.php');
}


$totalArticulos = $PuntoInteres->obtenerNumeroDePuntosInteres();

$numeroPagina = ceil($totalArticulos / $postPorPagina);


?>
<div id="cuerpoElemento">
    <h1 class="titulo">Lista de puntos de Interés</h1>
    <input type="text" name="busquedaPtoInteres" id="busquedaPtoInteres" placeholder="Buscar">
    <hr class="border">
    <ul class="containerPtoInteres" id="containerPtoInteres">
        <?php foreach ($statement as $row) { ?>

                <li class="targetPtoInteres">
                    <a href="index.php?page=puntoInteres&ptoInteres=<?php echo $row['id'] ?>">
                        <img src="<?php echo $row['imagen'] ?>" alt="Portada del punto de interés">
                    </a>
                    <div>
                        <a href="index.php?page=puntoInteres&ptoInteres=<?php echo $row['id'] ?>"><h3><?php echo $row['titulo'] ?></h3></a>
                        <p><?php echo devuelveCienCaracteres($row['descripcion'])."...<a href=\"index.php?page=puntoInteres&ptoInteres=".$row['id']."\"> Leer Más</a>" ?></p>
                    </div>


                </li>

        <?php } ?>
    </ul>
</div>
<section class="paginacion">
    <ul>
        <?php if($pagina ==1): ?>
            <li class="disabled">&laquo;</li>
        <?php else: ?>
            <li><a href="index.php?page=listarPtoInteres&pagina=<?php echo $pagina-1 ?>">&laquo;</a></li>
        <?php endif; ?>

        <?php
        for($i=1;$i<=$numeroPagina;$i++){
            if($pagina ==$i) {
                echo "<li class='active'><a href='index.php?page=listarPtoInteres&pagina=$i'>$i</a></li>";
            }else{
                echo "<li><a href='index.php?page=listarPtoInteres&pagina=$i'>$i</a></li>";
            }
        }
        ?>
        <?php if($pagina == $numeroPagina): ?>
            <li class="disabled">&raquo;</li>
        <?php else: ?>
            <li><a href="index.php?page=listarPtoInteres&pagina=<?php echo $pagina+1 ?>">&raquo;</a></li>
        <?php endif; ?>

    </ul>
</section>