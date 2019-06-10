<?php
/**
 * Created by PhpStorm.
 * User: marco
 * Date: 25/02/2019
 * Time: 19:36
 */

session_start();
session_unset();
session_destroy();
session_regenerate_id(true);
$_SESSION = [];
header("Location:index.php");
?>