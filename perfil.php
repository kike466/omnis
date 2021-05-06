<?php
require("comunes/header.php");

?>

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