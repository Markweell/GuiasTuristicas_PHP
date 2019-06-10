<?php


function redireccionSinoUsuario(){
 if (empty($_SESSION['perfil']) or $_SESSION['perfil'] != 'User'){
   header('Location: index.php?page=cierreSesion');
 }
}

function redireccionSinoAdministrador(){
    if (empty($_SESSION['perfil']) or $_SESSION['perfil'] != 'Admin'){
        header('Location: index.php?page=cierreSesion');
    }
}

function redireccionSinoColaborador(){
    if (empty($_SESSION['perfil']) or $_SESSION['perfil'] != 'Collaborator'){
        header('Location: index.php?page=cierreSesion');
    }
}



 ?>
