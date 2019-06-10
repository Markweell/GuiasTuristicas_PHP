<?php
/**
 * Created by PhpStorm.
 * User: suso
 * Date: 28/11/17
 * Time: 23:23
 */


ob_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("includes/head.php"); ?>
</head>
<body>
<?php if (isset($_GET['page'])&&($_GET['page'] === "contenido")): ?>
<header>
    <?php if (isset($_GET['page']) && ($_GET['page'] === "contenido")) {
        include("includes/header.php");
    }
    ?>
</header>
<?php endif; ?>
<?php if (isset($_GET['page'])) {
    include("includes/nav.php");
    }
?>

    <?php include("includes/pages.php"); ?>

<footer style="width: 100%">
    <?php if (isset($_GET['page']) &&  ($_GET['page'] !== "login") && ($_GET['page'] !== "registrate")) {
        include("includes/footer.php");
    }
    ?>
</footer>

</body>
</html>

<?php
ob_end_flush();
?>
