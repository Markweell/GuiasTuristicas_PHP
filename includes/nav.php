<!--<nav>
    <ul>
        <a href="#">
            <li><i class="material-icons">home</i> Inicio</li>
        </a>
        <a href="#">
            <li><i class="material-icons">photo_library</i> Puntos de interes</li>
        </a>
        <a href="#">
            <li><i class="material-icons">public</i> Guías</li>
        </a>
        <?php

session_start();

/*if ($_SESSION['tipo_usuario'] == "admin"): */ ?>
            <a href="crearPuntoInteres.php">
                <li><i class="material-icons">lock_open</i>Crear Punto Interés</li>
            </a>
            <a href="crearUnaGuiaTuristica.php">
                <li><i class="material-icons">lock_open</i>Crear Guía</li>
            </a>
            <a href="administrar.php">
                <li><i class="material-icons">lock_open</i>Administrar</li>
            </a>
        <?php /*endif; */ ?>
        <a href="index.php?page=cerrar">
            <li><i class="material-icons">close</i> Cerrar Sesión</li>
        </a>
    </ul>

</nav>-->
<nav class="navbar navbar-expand-lg navbar-dark col-12" style="background-color: #F57C00;">
    <button class="navbar-toggler active" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav" style=" width: 100%;">
        <ul class="navbar-nav" style=" width: 100%; display:flex; justify-content: space-around;">
            <li class="nav-item active">
                <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=contenido"><i style="margin-right: 5px" class="fas fa-home fa-2x"></i>Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=listarPtoInteres&pagina=1">
                    <i style="margin-right: 5px" class="fas fa-map-marker fa-2x"></i>Puntos de interes<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=listarGuiasTuristicas">
                    <i style="margin-right: 5px" class="fas fa-map-marked fa-2x"></i>Guías<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=contacto">
                    <i style="margin-right: 5px" class="fas fa-phone fa-2x"></i>Contacto<span class="sr-only">(current)</span></a>
            </li>
            <?php if (isset($_SESSION['tipo_usuario']) and $_SESSION['tipo_usuario']  == "admin"):?>
                <li class="nav-item active">
                    <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=crearPuntoInteres">
                        <i style="margin-right: 5px"  class="fas fa-plus-circle fa-2x"></i>Crear puntos de interés<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=crearUnaGuiaTuristica">
                        <i style="margin-right: 5px"  class="fas fa-plus-circle fa-2x"></i>Crear Guía<span class="sr-only">(current)</span></a>
                </li>

            <?php endif;  ?>
            <?php if (isset($_SESSION['usuario'])) : ?>
            <li class="nav-item ">
                <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=cerrar">
                    <i style="margin-right: 5px" class="fas fa-power-off fa-2x"></i>Cerrar Sesión<span class="sr-only">(current)</span></a>
            </li>
            <?php else:  ?>
                <?php if (isset($_GET['page']) && ($_GET['page'] !== "login") && ($_GET['page'] !== "registrate")) :?>
                <li class="nav-item active">
                    <a class="nav-link" style="font-size: 1.2rem;padding: 10px;" href="index.php?page=login">
                        <i style="margin-right: 5px" class="fas fa-sign-in-alt fa-2x"></i>Login<span class="sr-only">(current)</span></a>
                </li>
                <?php endif;  ?>
            <?php endif;  ?>

        </ul>
    </div>
</nav>
