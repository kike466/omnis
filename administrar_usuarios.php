<?php
require("clases/usuario.php");
require("clases/pedidos.php");
if (isset($_POST['hacer_admin'])) {
    $correo=$_POST['email'];
    usuario::hacer_admin($correo);
}
if (isset($_POST['hacer_trabajador'])) {
    $correo=$_POST['email'];
    usuario::hacer_trabajador($correo);
}

if (isset($_POST['hacer_usuario'])) {
    $correo=$_POST['email'];
    usuario::hacer_usuario($correo);
}
if (isset($_POST['borrar'])) {
    $correo=$_POST['email'];
    pedidos::borrar_pedidos($correo);
    usuario::borrar_usuario($correo);
}

require("./comunes/header.php");
?>

    <!-- inicio main -->
    <div id="administrar" class="container-fluid">
        <div id="usuarios">
        
           
        </div>



    </div>
    <!-- fin main -->
    <script>
        $(document).ready(function() {
            cargar();

            function cargar(pagina) {
                $.ajax({
                    url: "./controlador/paginacion_usuarios.php",
                    method: "POST",
                    data: {
                        pagina: pagina
                    },
                    success: function(data) {
                        $("#usuarios").html(data);
                    }

                })
            }

            $(document).on('click', '.paginacion', function() {
                var pagina = $(this).attr("pagina");
                cargar(pagina);
            });
        });
    </script>
    
</body>


</html>