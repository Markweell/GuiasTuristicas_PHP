<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 25/02/2019
 * Time: 16:43
 */


require_once "clases/Usuarios.php";

//require 'utiles/funciones.php';
//require 'utiles/BaseDeDatos.php';

//if (isset($_SESSION['usuario'])) {
//  header('Location: index.php');
//}
$errores = '';

if (isset($_POST["registro"])) {// Si el método es por post si se reciben

    $usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (empty($usuario) or empty($password) or empty($password2)) {
        $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
    } else {


        if ($password != $password2) {
            $errores .= '<li>Las contraseñas no son iguales</li>';
        } else {

            $gestionUsuarios = new Usuarios();
            $comprobarNombre = $gestionUsuarios->getUsuario($_POST["usuario"]);
            if ($comprobarNombre == $_POST["usuario"]) {
                $errores .= '<li>Por favor rellena todos los datos correctamente</li>';

            } else {
                if ($gestionUsuarios->crearUsuario($_POST["usuario"], $_POST["password"])) {
                    $errores .= '<li>Login true</li>';

                    // header('Location:  index.php?page=registrate');
                } else {
                    $errores .= '<li>Error al crear el usuario</li>';
                }
            }
        }
    }
}
?>

<div class="contenedor">
    <h1 class="titulo">Registrate</h1>
    <hr class="border">
    <form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" method="POST" class="formulario" name="formLogin">

        <div class="form-group">
            <i class="icono izquierda fas fa-user"></i><input type="text" name="usuario" class="usuario"
                                                              placeholder="usuario">
        </div>
        <div class="form-group">
            <i class="icono izquierda fas fa-lock"></i><input type="password" name="password" class="password"
                                                              placeholder="Contraseña">
        </div>
        <div class="form-group">
            <i class="icono izquierda fas fa-lock"></i><input type="password" name="password2" class="password_btn"
                                                              placeholder="Repetir Contraseña">
            <i for="enviar" style="position:relative" class="submit-btn fas fa-arrow-right">
                <input class="submit-btn fas fa-arrow-right" id="enviar"
                       style="position:absolute; top:0; left:0; border:none; background: transparent" type='submit'
                       name='registro' value=""></i>
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
        ¿Ya tienes cuenta?
        <a href="index.php?page=login">Iniciar Sesión</a>
    </p>
</div>
