<?php
require_once("./clases/productos.php");
require_once("./clases/pedidos.php");
require_once("./clases/historial.php");
require_once("./clases/usuario.php");
require_once("./clases/factura.php");
require_once("./clases/conexion.php");

if (isset($_POST["logout"])) {
    unset($_SESSION["login"]);
    if (isset($_COOKIE['sesion_iniciada'])) {
        setcookie('sesion_iniciada', '', time() - 3600);
    }

    header("Location: index.php");
    exit;
}

if (isset($_COOKIE['sesion_iniciada'])) {

    $email = $_COOKIE['sesion_iniciada'];

    $user = usuario::datos_usuario($email);

    session_start();


    $_SESSION["login"]["nombre"] = $user["nombre"];
    $_SESSION["login"]["apellidos"] = $user["apellidos"];
    $_SESSION["login"]["id"] = $user["id_usuarios"];
    $_SESSION["login"]["email"] = $user["email"];
    $_SESSION["login"]["provincia"] = $user["provincia"];
    $_SESSION["login"]["direccion"] = $user["direccion"];
    $_SESSION["login"]["codePostal"] = $user["codePostal"];
    $_SESSION["login"]["tipo"] = $user["tipo"];

    new usuario($user["id_usuarios"]);
}

if (isset($_SESSION["login"])) {

    if (isset($_POST['comprar'])) {

        $id_usr = $_SESSION['login']['id'];
        $id_pro = $_POST['id_producto'];
        $nombre_pro = $_POST['nombre_producto'];
        $precio_producto = $_POST['precio_producto'];
        $cantidad = $_POST['cantidad'];

        $nombre_cliente = $_SESSION['login']['nombre'];
        $apellidos_cliente = $_SESSION['login']['apellidos'];
        $direccion_cliente = $_SESSION['login']['direccion'];
        $provincia_cliente = $_SESSION['login']['provincia'];
        $codigo_postal_cliente = $_SESSION['login']['codePostal'];

        $fecha = pedidos::obtener_fecha();

        pedidos::insertar_pedido($id_usr, $id_pro, $cantidad, $fecha, $direccion_cliente, $codigo_postal_cliente);

        historial::insertar_producto_historial($id_usr, $id_pro);

        $id_pedido = pedidos::obtener_pedido($id_usr, $fecha);
        $id_pe = $id_pedido['id_pedido'];

        $factura = new factura($id_pe, $fecha, $cantidad, $nombre_pro, $precio_producto, $nombre_cliente, $apellidos_cliente, $direccion_cliente, $provincia_cliente, $codigo_postal_cliente);

        $factura->construir_factura();

        producto::restar_productos($id_pro, $cantidad);
    }
} else {
    if (isset($_POST['comprar'])) {
        header("Location: registrarse.php");
    }
}


if (isset($_GET['buscar'])) {
    $nombre_productos = $_GET['producto_buscar'];
} else {
    $nombre_productos = "";
}

require_once('clases/paginacion.php');

$conn  = conexion::abrir_conexion();

$limit      = (isset($_GET['limit'])) ? $_GET['limit'] : 2;
$page       = (isset($_GET['page'])) ? $_GET['page'] : 1;
$links      = (isset($_GET['links'])) ? $_GET['links'] : 1;

$nombre_productos      = (isset($_GET['producto_buscar'])) ? $_GET['producto_buscar'] : $nombre_productos;


$query      = "SELECT * FROM productos";

$Paginacion  = new Paginacion($conn, $query);

//$nombre_productos = (filter_input(INPUT_GET, 'producto_buscar'));

$Paginacion->set_busqueda($nombre_productos);


$Paginacion->cambiar_query();



$results    = $Paginacion->get_datos_productos($limit, $page);




?>
<!DOCTYPE html>
<html lang="en">

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
    <script src="js/alert_comprar.js"></script>
    <script src="js/modo_claro_oscuro.js?v=10.2.34"></script>

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
                            echo "<input type='submit' name='logout' value='Desconectarse'>";
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
    <!-- fin header -->
    <!-- inicio main -->
    <div id="contenedor_central" class="container-fluid ">
        <div id="modo_claro_oscuro">
            <span id="texto_modo">Modo claro</span>
            <button id="cambiar_modo"><i class="far fa-sun"></i></button>
        </div>
        <div id="row_central" class="row">
            <div id="col_menu_central" class="col-12 col-md-2 col-xl-1">
                <div id="menu_categorias" class="menu_2">
                    <i class="fas fa-bars"></i>
                </div>
                <div id="formulario_categorias" class="items_Menu_Categorias ">
                    <span>Categorias</span>
                    <form action="" method="post">
                        <div id="checks">
                            <div class="checks_contenido">A-Z<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">&lt;10€<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">&lt;50€<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">&lt;100€<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">hola5<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">hola6<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">hola7<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">hola8<input type="checkbox" name="" id=""></div>
                            <div class="checks_contenido">hola9<input type="checkbox" name="" id=""></div>
                        </div>
                        <div class="enviar_categorias">
                            <input type="submit" value="Enviar">
                        </div>
                    </form>

                </div>
            </div>
            <div id="col_productos" class="col-12 col-md-10 col-xl-10">
                <nav id="buscador" class="navbar ">
                    <div class="container justify-content-center">
                        <form action="" method="GET" class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Buscar" name="producto_buscar" value="<?php echo $nombre_productos; ?>" aria-label="Search">
                            <button id="buscar" name="buscar" class="btn" type="submit">Aplicar</button>
                        </form>
                    </div>
                </nav>

                <?php //require("comunes/buscador.php"); ?>

                <div id="productos">
                    <?php


                    for ($i = 0; $i < count($results); $i++) {

                        echo "<div class='contenedor_producto'>";

                        echo "<div class='nom_pun_st'>";
                        echo "<div class='nombre'>" . $results[$i]['nombre_producto'] . "  (" . $results[$i]['precio'] . "€)</div>";
                        echo "<div class='puntuacion'>Puntuacion " . $results[$i]['puntuacion'] . "/5</div>";
                        echo "<div class='stock'>Quedan " . $results[$i]['stock'] . " productos</div>";
                        echo " </div>";

                        echo " <div class='imagen_producto'>";
                        echo " <img class='img_producto' src='" . $results[$i]['ruta_Foto'] . "' alt='img/img_producto/interrogante-negro.png'>";
                        echo "</div>";

                        echo " <div class='descripcion_producto '>";
                        echo " <p>" . $results[$i]['descripcion'] . "</p>";
                        echo " </div>";

                        echo " <div class='btn_comprar'>";
                        echo "<i class='fas fa-cart-plus'></i><div class='texto_comprar'>";
                        echo "<form action=" . $_SERVER["PHP_SELF"] . " method='post'>";
                        echo "<input type='hidden' name='id_producto' value=" . $results[$i]['id_producto'] . ">";
                        echo "<input type='hidden' name='nombre_producto' value=" . $results[$i]['nombre_producto'] . ">";
                        echo "<input type='hidden' name='precio_producto' value=" . $results[$i]['precio'] . ">";
                        echo "<input type='submit' value='Comprar' id='comprar' name='comprar'></div>";
                        echo "Cantidad<input type='number' name='cantidad' value='1' min='1' max=" . $results[$i]['stock'] . " class='cantidad_producto_input'>";
                        echo "</form>";
                        echo " </div>";
                        echo " </div>";
                    }



                    ?>

                </div>
                <nav id="paginacion" aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <?php

                        echo $Paginacion->createLinks($links);

                        ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- fin main -->
    <!-- inicio footer -->
    <footer>
        <div id="contenedor_footer" class="row">
            <div id="col_copy" class="col-12">
                <div id="copy">
                    <div id="contenedor_copy">
                        <span id="nombre">Enrique Martínez Galvañ</span>
                        <span><i id="copy_symbol" class="far fa-copyright"></i></span>
                    </div>
                </div>
            </div>
            <div id="col_cards" class="col-12">
                <nav id="contenedor_cards">

                    <div class="card" style="width: 18rem;">

                        <div class="card-body">
                            <h5 class="card-title">Contacto</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">

                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>

                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">

                        <div class="card-body">
                            <h5 class="card-title">Sobre Nosotros</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>

                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </footer>
    <!-- fin footer -->
</body>

</html>