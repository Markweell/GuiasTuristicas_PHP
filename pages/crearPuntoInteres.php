<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 01/03/2019
 * Time: 21:23
 */

require 'utiles/funciones.php';
require_once "clases/PuntoInteres.php";
header('Content-Type: text/html; charset=utf-8');

if(!isset($_SESSION["tipo_usuario"])||$_SESSION["tipo_usuario"]!=="admin"){
    header("Location: index.php?page=Contenido");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {// Si el método es por post si se reciben

    $titulo =$_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = "asdqwe";
    $telefono = $_POST['telefono'];
    $id_Usuario = $_SESSION['id_usuario'];
    $errores = '';
    if (empty($titulo) or empty($descripcion) or empty($imagen) or empty($telefono)) {
        $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
    } else {
        $puntoInteres = new PuntoInteres();
        $carpetaDestino="./img/imagenesPuntosInteres/";
        $filename = md5(uniqid()).".".obtenerExtensionArchivo($_FILES['imagen']['name']);
        $imagen = $carpetaDestino.$filename;
        move_uploaded_file($_FILES['imagen']['tmp_name'],$carpetaDestino.$filename);
        if($puntoInteres->crearPuntoInteres($titulo,$descripcion,$imagen,$telefono,$id_Usuario)){
            //$_SESSION['puntoInteres_id'] = $puntoInteres->getId($titulo);
            header('Location: index.php?page=puntoInteres&ptoInteres='.$puntoInteres->getId($titulo));
        }else{
            $errores .='<li>Ese punto de interés ya existe</li>';
        }
    }
}


?>

    <div id="cuerpoElemento">
        <h1 class="titulo">Agregar Punto de Interés</h1>
        <hr class="border">
        <form action="" method="POST" class="formulario_PuntoInteres"
              name="login" enctype="multipart/form-data">

            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" class="usuario" placeholder="título">

            <label for="descripcion">Descripción:</label>
            <textarea type="text" name="descripcion" id="descripcion" class="usuario" placeholder=""></textarea>

            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="usuario" placeholder="imagen">

            <label for="Teléfono">Teléfono:</label>
            <input type="text" name="telefono" id="Teléfono" class="password_btn" placeholder="telefono">
            <input type="submit" value="Crear Punto de Interés">

            <?php if (!empty($errores)): ?>
                <div class="error">
                    <ul>
                        <?php echo $errores; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </form>

    </div>
<?php
