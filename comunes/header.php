<?php
session_start();
if (isset($_POST["logout"])) {
    unset($_SESSION["login"]);
    if (isset($_COOKIE['sesion_iniciada'])) {
        setcookie('sesion_iniciada', '', time() - 3600);
    }
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/jpg" href="./img/logo/favicon.ico"/>
    <title>Omnis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/menus.js"></script>
  

</head>

<body>
<!-- inicio header -->
<header>
    <div id="contenedor_header" class="container-fluid">
        <div id="row_header" class="row">
            <div id="div_logo" class="col-4">
                <a href="./index.php">
                    <img id="logo" src="img/logo/logo-Omnis.png" alt="">
                </a>
                <span id="nombre_Tienda">mnis</span>

            </div>

            <div id="div_Sign_Menu" class="col-8">


                <div id="sign">
                    <?php
                    if (isset($_SESSION["login"])) {
                        echo "<form id='logoutBoton' action=" . $_SERVER["PHP_SELF"] . " method='post'>";
                        echo "<input type='submit' name='logout' value='Cerrar Sesion'>";
                        echo "</form>";
                    } else {
                        echo "<span>Registrarse-></span>";
                        echo "<a href='./registrarse.php' style='width: 0px;'><i class='fas fa-sign-in-alt'></i></a>";
                    }

                    ?>

                </div>
                <?php
                if (isset($_SESSION["login"])) {
                    echo "<nav id='menu_header'>";
                    echo "<div class='menu_1'>";
                    echo "<i class='fas fa-bars'></i>";
                    echo "</div>";
                    echo "<div class='items_Menu_Header'>";
                    echo "<a class='a_menu_header' href='./index.php'>Inicio</a>";
                    echo "<a class='a_menu_header' href='./perfil.php'>Perfil</a>";
                    echo "<a class='a_menu_header' href='./historial.php'>Historial</a>";
                    if ($_SESSION["login"]["tipo"] == 1 || $_SESSION["login"]["tipo"] == 2) {
                        echo "<a class='a_menu_header' href='./productos_trabajadores.php'>Productos</a>";
                    }
                    if ($_SESSION["login"]["tipo"] == 1) {
                        echo "<a class='a_menu_header' href='./administrar_usuarios.php'>Administrar</a>";
                    }
                    echo "</div>";
                    echo "</nav>";
                }
                ?>

            </div>
        </div>
    </div>
</header>
