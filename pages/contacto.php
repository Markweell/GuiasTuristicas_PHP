<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 11/03/2019
 * Time: 18:33
 */

require 'utiles/funciones.php';
require_once "clases/PuntoInteres.php";
require 'pages/PhpMailer/vendor/autoload.php';
header('Content-Type: text/html; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader


$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {// Si el método es por post si se reciben

    $nombre =$_POST['nombre'];
    $correo=$_POST['Correo'];
    $telefono = $_POST['telefono'];
    $id_Usuario = $_SESSION['id_usuario'];
    $errores = '';
    if (empty($nombre) or empty($correo) or empty($telefono)) {
        $errores .= '<li>Por favor rellena todos los datos correctamente</li>';
    } else {
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Username = "emaildepruebaparaphp@gmail.com";                 // SMTP username
            $mail->Password = "php1234!";                           // SMTP password
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom('emaildepruebaparaphp@gmail.com', 'Pedro');
            $mail->addAddress($correo);

            $mail->isHTML(true);
            $mail->Subject = 'Hola '.$nombre.', Bienvenido al la web de guias Turisticas';
            $mail->Body    = 'Ha contactado con exito con la web de guias turisticas.';
            $mail->AltBody = 'Ha contactado con exito con la web de guias turisticas.';

            $mail->send();
            $sucessful='Le hemos enviado un mail de confirmación';
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }


    }
}

?>
<div id="cuerpoElemento">
    <h1 class="titulo">Agregar Punto de Interés</h1>
    <hr class="border">
    <form action="" method="POST" class="formulario_PuntoInteres"
          name="login" enctype="multipart/form-data">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="usuario" placeholder="Nombre">

        <label for="Correo">Correo:</label>
        <input type="text" name="Correo" id="Correo" class="usuario" placeholder="Correo">

        <label for="Teléfono">Teléfono:</label>
        <input type="text" name="telefono" id="Teléfono" class="password_btn" placeholder="telefono">
        <input type="submit" value="Contactar">
        <?php if (!empty($sucessful)): ?>
        <div class="error">
            <ul>
                <?php echo $sucessful; ?>
            </ul>
        </div>
        <?php endif; ?>
    </form>

</div>
