<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dD.js"></script>

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
                        <span>nombre</span>
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <nav id="menu_header">
                        <div class="menu_1">
                            <i class="fas fa-bars"></i>
                        </div>
                        <div class="items_Menu_Header">
                            <a class="a_menu_header" href="./index.php">Inicio</a>
                            <a class="a_menu_header" href="./perfil.php">Perfil</a>
                            <a class="a_menu_header" href="./modi_Perfil.html">Historial</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- fin header -->
    <!-- inicio main -->
    <div id="perfil" class="container-fluid">
        <div id="contenedor_global_p" class="row">
            <div class="col-md-4 mx-auto">
                <div class="shadow rounded overflow-hidden">
                    <div class="px-5 pb-4 cover1">
                        <div class=" align-items-end profile-head">
                            <div id="contenedor_Imagen_Perfil" class="profile ">
                                <img src="img/img_producto/interrogante-negro.png" alt="..." id="img_Perfil">

                            </div>
                            <div id="editar_perfil">
                                <a href="./modi_Perfil.html" id="edit_perfil_boton" class="btn  btn-sm ">Editar Perfil</a>
                            </div>

                            <div id="datos_usuario" class="mb-5 text-white">

                                <h4>
                                    <?php
                                    if (isset($_SESSION["login"])) {
                                       $nombre= $_SESSION["login"]["nombre"];
                                       echo $nombre;
                                    }
                                    ?>
                                </h4>
                                <p> <i class="fas fa-map-marker-alt"></i>
                                    <?php
                                         if (isset($_SESSION["login"])) {
                                            $direccion= $_SESSION["login"]["direccion"];
                                            echo $direccion;
                                         }

                                    ?>
                                </p>
                                <p><i class="fas fa-envelope-square"></i> 
                                    <span id="email_perfil">
                                        <?php

                                        if (isset($_SESSION["login"])) {
                                            $email= $_SESSION["login"]["email"];
                                       echo $email;
                                        }

                                        ?>
                                        </span></p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
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
                        <div class="imagen_card"><img src="img/img_producto/interrogante-negro.png" class="card-img-top" alt="..."></div>
                        <div class="card-body">
                            <h5 class="card-title">Contacto</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="imagen_card"><img src="img/img_producto/interrogante-negro.png" class="card-img-top" alt="..."></div>
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <div class="imagen_card"><img src="img/img_producto/interrogante-negro.png" class="card-img-top" alt="..."></div>
                        <div class="card-body">
                            <h5 class="card-title">Sobre Nosotros</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the
                                bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>

                </nav>
            </div>
        </div>
    </footer>
    <!-- fin footer -->
</body>

</html>