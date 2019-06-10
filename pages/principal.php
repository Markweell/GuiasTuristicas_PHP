<?php
/**
 * Created by PhpStorm.
 * User: suso
 * Date: 5/03/18
 * Time: 19:33
 */

session_start();
if(isset($_SESSION['usuario'])){
    header('Location: index.php?page=contenido');

}else{
    header('Location:index.php?page=contenido');
}
?>

