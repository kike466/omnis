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

require("./comunes/header.php");
?>

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