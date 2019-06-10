<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                        // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Username = "emaildepruebaparaphp@gmail.com";                 // SMTP username
    $mail->Password = "php1234!";                           // SMTP password
    $mail->Port = 587;                                    // TCP port to connect to

//    //Recipients
        $mail->setFrom('emaildepruebaparaphp@gmail.com', 'Pedro');
        $mail->addAddress('marcosgallardoperez@gmail.com');     // Add a recipient
//    $mail->addAddress('ellen@example.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');
//
//    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
//}
//require("PHPMailer-FE_v4.11/_lib/class.phpmailer.php");
//$mail = new PHPMailer();
//
////Luego tenemos que iniciar la validación por SMTP:
//$mail->IsSMTP();
//$mail->SMTPAuth = true;
//$mail->Host = "mail.localhost"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
//$mail->Username = "emaildepruebaparaphp@gmail.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente.
//$mail->Password = "php1234!"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
//$mail->Port = 465; // Puerto de conexión al servidor de envio.
//$mail->From = "marcosgallardoperez@gmail.com"; // A RELLENARDesde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
//$mail->FromName = "Marcos"; //A RELLENAR Nombre a mostrar del remitente.
//$mail->AddAddress("marcosgallardoperez@gmail.com"); // Esta es la dirección a donde enviamos
//$mail->IsHTML(true); // El correo se envía como HTML
//$mail->Subject = "Hola"; // Este es el titulo del email.
//$body = "Hola mundo. Esta es la primer línea ";
//$body .= "Aquí continuamos el mensaje";
//$mail->Body = $body; // Mensaje a enviar.
//$exito = $mail->Send(); // Envía el correo.
//if($exito){ echo "El correo fue enviado correctamente."; }else{ echo "Hubo un problema. Contacta a un administrador."; }
?>
