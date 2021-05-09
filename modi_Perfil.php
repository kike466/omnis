<?php

require("clases/usuario.php");
require("comunes/header.php");
function validar($validar)
{
    $errores = array();

    if (empty(trim($validar['provincia'])) || empty(trim($validar['codePostal'])) || empty(trim($validar['direccion'])) || empty(trim($validar['correo'])) || empty(trim($validar['pass']))) {
        $errores[0] = "Algun campo esta vacio";
    }


    if (!empty($validar['correo'])) {
        $em = $validar['correo'];
        if ($_SESSION["login"]["email"] != $em) {
            if (usuario::existe_correo($em)) {
                $errores[2] = "El correo ya existe";
            }
        }
    }

    return $errores;
}

if (isset($_POST['modificar'])) {
    $validar = validar($_POST);

    if (empty($validar)) {
        $provincia = $_POST['provincia'];
        $codePostal = $_POST['codePostal'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $pass = $_POST['pass'];
        $id = $_SESSION["login"]["id"];

        
        $_SESSION["login"]["email"] = $correo;
        $_SESSION["login"]["provincia"] = $provincia;
        $_SESSION["login"]["direccion"] =  $direccion;
        $_SESSION["login"]["codePostal"] = $codePostal;

        usuario::actualizar_usuario($provincia, $codePostal, $direccion, $correo, $pass, $id);
        header("Location: perfil.php");
    exit;
    }
}


?>

<!-- inicio main -->
<div id="modi_perfil" class="container-fluid">

    <div id="contenedor_global_mp" class="row px-3">
        <div class="col-xs-4 col-md-7 mx-auto">
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-3 pb-5 cover1">
                    <div class=" pb-5 profile-head">
                        <h4 class="d-flex justify-content-center text-white">Modificar Perfil</h4>
                        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="cambiar_perfil" class="text-white">
                            <div id="datos" class="mx-auto ">

                                <div class="elemento_form">
                                    <div class="texto_form">Nueva foto:</div>
                                    <div class="file-select input_form" id="file_foto">
                                        <input type="file" name="file_foto" class="input_modi_foto">
                                    </div>
                                </div>

                                <div id="grupo__cambiar_provincia" class="elemento_form">
                                    <div class="texto_form">Provincia:</div>
                                    <div class="input_form"><input class="inputs_form" type="text" name="provincia" id="provincia" value="<?php echo $_SESSION["login"]["provincia"]; ?>" placeholder="Ingrese su Provincia">
                                        <i class="validacion fas fa-times-circle"></i>
                                    </div>
                                    <div class="contenedorErrorValidar">
                                        <p class="errorValidar">La provincia tiene que ser de 2 a 30 caracteres puede contener letras , espacios y pueden llevar acentos.</p>
                                    </div>
                                </div>

                                <div id="grupo__cambiar_codePostal" class="elemento_form">
                                    <div class="texto_form">Codigo Postal:</div>
                                    <div class="input_form"><input class="inputs_form" type="text" name="codePostal" value="<?php echo $_SESSION["login"]["codePostal"]; ?>" id="codePostal" placeholder="Ingrese su codigo postal">
                                        <i class="validacion fas fa-times-circle"></i>
                                    </div>
                                    <div class="contenedorErrorValidar">
                                        <p class="errorValidar">Tiene que tener 5 dígitos</p>
                                    </div>
                                </div>

                                <div id="grupo__cambiar_direccion" class="elemento_form">
                                    <div class="texto_form">Direccion:</div>
                                    <div class="input_form"><input class="inputs_form" type="text" name="direccion" value="<?php echo $_SESSION["login"]["direccion"]; ?>" id="direccion" placeholder="Nombre Nombre nº10 / Nombre Nombre 10">
                                        <i class="validacion fas fa-times-circle"></i>
                                    </div>
                                    <div class="contenedorErrorValidar">
                                        <p class="errorValidar">1,2 o 3 palabras seguidas de un espacio opcional (con nº) y el numero</p>
                                    </div>

                                </div>
                                <div id="grupo__cambiar_correo" class="elemento_form">
                                    <div class="texto_form">Email:</div>
                                    <div class="input_form"><input class="inputs_form" type="email" name="correo" id="correoC" value="<?php echo $_SESSION["login"]["email"]; ?>" placeholder="ejemplo@gmail.com">
                                        <i class="validacion fas fa-times-circle"></i>
                                    </div>
                                    <div class="contenedorErrorValidar">
                                        <p class="errorValidar">Introducir un correo valido</p>
                                    </div>
                                </div>

                                <div id="grupo__cambiar_pass" class="elemento_form">
                                    <div class="texto_form">Contraseña:</div>
                                    <div class="input_form"><input class="inputs_form" type="password" name="pass" id="pass" placeholder="De 4 a 40 caracteres">
                                        <i class="validacion fas fa-times-circle"></i>
                                    </div>
                                    <div class="contenedorErrorValidar">
                                        <p class="errorValidar">De 4 a 40 caracteres.</p>
                                    </div>
                                </div>



                            </div>
                            <div id="btn_cambiar" class="mb-5 d-flex justify-content-center"><input type="submit" name="modificar" value="Cambiar">
                                <?php
                                if (isset($_POST["modificar"])) {
                                    if (!empty($validar)) {
                                        echo "<div style='width: 100%;'>";
                                        echo "<p id='erroresRegistrar' style='color: red; text-align: center;'>";
                                        foreach ($validar as $value) {
                                            echo $value . "<br>";
                                        }
                                        echo "</p>";
                                        echo "</div>";
                                    } else {
                                        echo "<div style='width: 100%;'>";
                                        echo "<p style='color: green; text-align: center;'>El usuario ha sido actualizado correctamente</p>";
                                        echo "</div>";
                                    }
                                }


                                ?></div>
                        </form>
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
<script src="js/validar_formulario.js"></script>

</html>