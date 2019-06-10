<?php
/**
 * @User: Guillermo Boquizo Sánchez
 * @File: login.php
 * Date: 11/12/18
 * @Description: Página de login del sitio.
 * @license http://opensource.org/licenses/gpl-license.php  GNU Public License
 */

require_once "clases/Usuarios.php";

//require 'utiles/funciones.php';
//require 'utiles/BaseDeDatos.php';

$errores = "";
$nombre = "";

/*if (!isset($_SESSION["aut"])) {
    $_SESSION["aut"] = false;
    $_SESSION["perfil"] = "invitado";
    $_SESSION["usuarioActual"] = "";
}*/

if (isset($_POST["login"])) {
    $gestionUsuarios = new Usuarios();


    if ($gestionUsuarios->autenticar($_POST["usuario"], $_POST["password"])) {
        $_SESSION["usuario"] = $gestionUsuarios->getUsuario($_POST["usuario"]);
        $_SESSION["id_usuario"] = $gestionUsuarios->getIdUsuario($_POST["usuario"]);
        $_SESSION["tipo_usuario"] = $gestionUsuarios->getUsuariosTipo($_SESSION["id_usuario"]);
        //echo $_POST["usuario"] . $_POST["password"] . " login correcto";
        header("Location: index.php?page=contenido");

        //if ($gestionUsuarios->comprobarUsuariosTipo($_POST["usuario"]) === "") {

       // }


        /*if ($_POST["nombre"] == "admin" AND $_POST["password"] == "admin") {
            $_SESSION["tipo"] = "admin";
            header("Location: index.php?page=administracion");
        } else {
            $_SESSION["perfil"] = "Alumno";
            header("Location: index.php?page=alumnos");
        }*/

    } else {
        $errores .= "<li>El usuario o la contraseña incorrectas</li>";
        $nombre = $_POST["usuario"];
    }
}
?>
<div class="contenedor">
    <h1 class="titulo">Iniciar Sesión</h1>

    <hr class="border">
    <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST" class="formulario">

        <div class="form-group">
            <i class="icono izquierda fas fa-user"></i><input type="text" name="usuario" class="usuario"
                                                              placeholder="usuario">
        </div>
        <div class="form-group">
            <i class="icono izquierda fas fa-lock"></i><input type="password" name="password" class="password_btn"
                                                              placeholder="Contraseña">
            <i for="enviar" style="position:relative" class="submit-btn fas fa-arrow-right">
                <input class="submit-btn fas fa-arrow-right" id="enviar"
                       style="position:absolute; top:0; left:0; border:none; background: transparent" type='submit'
                       name='login' value=""></i>
        </div>
        <?php if (!empty($errores)): ?>
            <div class="error">
                <ul>
                    <?php echo $errores; ?>
                </ul>
            </div>
        <?php endif; ?>

    </form>
    <p class="texto-registrate">
        ¿Aún no tienes cuenta?
        <a href="index.php?page=registrate">Registrate</a>
    </p>
</div>