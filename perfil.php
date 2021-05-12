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
                                <a href="./modi_Perfil.php" id="edit_perfil_boton" class="btn  btn-sm ">Editar Perfil</a>
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
    <?php
   
   require("./comunes/footer.php");
   
   ?>