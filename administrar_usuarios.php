<?php
require("clases/usuario.php");
if (isset($_POST['hacer_admin'])) {
    $correo=$_POST['email'];
    usuario::hacer_admin($correo);
}
if (isset($_POST['hacer_trabajador'])) {
    $correo=$_POST['email'];
    usuario::hacer_trabajador($correo);
}
if (isset($_POST['descender_a_trabajador'])) {
    $correo=$_POST['email'];
    usuario::hacer_trabajador($correo);
}
if (isset($_POST['descender_a_usuario'])) {
    $correo=$_POST['email'];
    usuario::hacer_usuario($correo);
}
if (isset($_POST['borrar'])) {
    $correo=$_POST['email'];
    usuario::borrar_usuario($correo);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">

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
    <div id="administrar" class="container-fluid">
        <div id="usuarios">
        <?php
                    $usuarios = usuario::nombre_email();
                    for ($i = 0; $i < count($usuarios); $i++) {
                        
                            echo "<div class='usuario'>";

                                echo "<section class='nombre_Email'>";
                                    echo "<span class='nombre_Administrar'>Nombre: ".$usuarios[$i]['nombre']."</span>";
                                    echo "<span class='email_Administrar'>Email: ".$usuarios[$i]['email']."</span>";
                                echo " </section>";

                                echo " <section class='botones'>";
                                    echo "<form action=".$_SERVER["PHP_SELF"]." method='post' id='form_administrar'>";
                                        echo "<input type='hidden' name='email' value=".$usuarios[$i]['email'].">";
                                        echo"<div class='hacer_admin'><input type='submit' value='Ascender a Administrador' name='hacer_admin'></div>";
                                        echo "<div class='ascender_trabajador'><input type='submit' value='Ascender a Trabajador' name='hacer_trabajador'></div>";
                                        echo "<div class='descender_trabajador'><input type='submit' value='Descender a Trabajador' name='descender_a_trabajador'></div>";
                                        echo "<div class='descender_usuario'><input type='submit' value='Descender a Usuario' name='descender_a_usuario'></div>";
                                        echo "<div class='borrar_usuario'><input type='submit' value='Borrar Usuario' name='borrar'></div>";
                                    echo "</form>";
                                echo " </section>";
                            echo " </div>";
                        
                    }
                    ?>
           
        </div>



    </div>
    <!-- fin main -->

</body>
<script src="js/validar_formulario.js"></script>

</html>