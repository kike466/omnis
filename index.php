<?php

session_start();
if(isset($_POST["logout"])){
    unset($_SESSION["login"]);
    header("Location: index.php");
}



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
    <script src="js/modo_claro_oscuro.js"></script>

</head>



<body>
    <!-- inicio header -->
    <header>
        <div id="contenedor_header" class="container-fluid">
            <div id="row_header" class="row">
                <div id="div_logo" class="col-4">
                    <a href="./index.html">
                        <img id="logo" src="img/logo/logo-Omnis.png" alt="">
                    </a>
                    <span id="nombre_Tienda">mnis</span>

                </div>

                <div id="div_Sign_Menu" class="col-8">


                    <div id="sign">
                        <?php
                        if (isset($_SESSION["login"])) {
                            echo "<span>Cerrar Sesión-></span>";
                            echo "<form id='logoutBoton' action=" . $_SERVER["PHP_SELF"] . " method='post'>";
                                echo "<input type='submit' name='logout' value='Logout'>";
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
                                echo "<a class='a_menu_header' href='./modi_Perfil.html'>Historial</a>";
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
                        <form action="" method="post" class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn bg-white" type="submit">Search</button>
                        </form>
                    </div>
                </nav>

                <div id="productos">
                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>

                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>

                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>

                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>

                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>

                    <div class="contenedor_producto">
                        <div class="imagen_producto"><img class="img_producto" src="img/img_producto/interrogante-negro.png" alt=""></div>
                        <div class="overflow-auto descripcion_producto ">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ullam voluptatem doloribus
                                nobis laborum voluptates? Eos velit rerum ut ea dignissimos omnis. Earum soluta eveniet
                                quis ullam tenetur consectetur libero veniam.</p>
                        </div>
                        <div class="btn_comprar"><i class="fas fa-cart-plus"></i></div>
                    </div>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a>
                        </li>
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