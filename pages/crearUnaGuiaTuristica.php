<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/03/2019
 * Time: 21:27
 */;
 if(!isset($_SESSION["tipo_usuario"])||$_SESSION["tipo_usuario"]!=="admin"){
     header("Location: index.php?page=Contenido");
 }
require 'utiles/funciones.php';
require_once "clases/Recorrido.php";
require_once "clases/GuiaTuristica.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $recorrido= new Recorrido();
        $guiaTuristica = new GuiaTuristica();
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        //$recorridos=[];
        $date = getdate ();
        $date = $date["year"]."-".$date["mon"]."-".$date["mday"]." ".$date["hours"].":".$date["minutes"].":".$date["seconds"];
        $id_Usuario = $_SESSION['id_usuario'];
        $errores = '';
        $i=1;

        if (empty($titulo) or empty($descripcion) or empty($date) or empty($id_Usuario)) {
            $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
        }else{
            $guiaTuristica->crearGuiaTuristica($titulo,$descripcion,$date,$id_Usuario);
        }
        $idGuiaTuristica = $guiaTuristica->getId($titulo);


        while (isset($_POST['titulo_recorrido'.$i])){
            $recorridos=[];
            $banderaErrores=false;

            if(empty($_POST['titulo_recorrido'.$i])){
                $errores .= '<li>Asegurate de que rellenas todos los campos</li>';
                $banderaErrores=true;
            }else{
                array_push($recorridos,$_POST['titulo_recorrido'.$i]);
                array_push($recorridos,"1");
                $recorridos["1"]=[];
            }
            $j=1;
            while (isset($_POST['selectPuntosInteres_'.$i.'_'.$j])){
                if(empty($_POST['selectPuntosInteres_'.$i.'_'.$j])){
                    $errores .= '<li>Asegurate de que rellenas todos los campos</li>';
                    $banderaErrores=true;
                }else{
                    array_push($recorridos["1"],$j-1);
                    $recorridos["1"][$j-1]=$_POST['selectPuntosInteres_'.$i.'_'.$j];
                }
                $j++;
            }
            if(!$banderaErrores){
                $recorrido->crearRecorrido($recorridos[0],$idGuiaTuristica,$recorridos[1]);
            }
            $i++;
        }
}

?>
<div id="cuerpoElemento">
    <h1 class="titulo">Agregar Guía Turística</h1>
    <hr class="border">
    <form action="" method="POST" class="formulario_Guia_turistica"
          name="login" enctype="multipart/form-data">

        <div class="row">
            <div class="col-2">
                <label for="titulo">Título:</label>
            </div>
            <div class="col-10">
                <input type="text" class="form-control" name="titulo" id="titulo" class="usuario" placeholder="título"><br/>
            </div>

        </div>
        <div class="form-group">
            <label for="descripcion">Descripción:</label><br/>
            <textarea type="text" name="descripcion" id="descripcion" placeholder="Inserta aquí tu descripción" class="form-control" id="descripcion" rows="3"></textarea>
        </div>




<!--        <textarea  cols="40" rows="5" style="resize: none"></textarea><br/><br/>-->

        <div id="listado_recorridos"></div>
        <button type="button" id="anadir_recorrido" class="btn boton">Añadir recorrido</button>
        <button type="submit" class="btn boton">Crear Guía Turística</button>
<!--        <input type="button" value="Añadir recorrido" >-->
<!--        <input type="submit" value="Crear Guía Turística">-->

        <?php if (!empty($errores)): ?>
            <div class="error">
                <ul>
                    <?php echo $errores; ?>
                </ul>
            </div>
        <?php endif; ?>
    </form>

</div>
