<?php

if (!isset($_GET['page'])) {
    include("pages/principal.php");//pagina principal, poner login en caso de que sea la principal
} else if (isset($_GET['page'])) {
    include("pages/" . $_GET['page'] . ".php");
}
