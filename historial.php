<?php
require("clases/historial.php");
require("clases/pedidos.php");
require("clases/productos.php");
require("clases/usuario.php");
require("./comunes/header.php");


$id_usuario = $_SESSION['login']['id'];


if (isset($_POST['cancelar'])) {
    $id_pro = $_POST['id_producto'];
    $cantidad = $_POST['cantidad_devolver'];
    $fecha = $_POST['fecha'];

    $id_pedido = $_POST['id_pedido'];

    pedidos::cancelar_pedido($id_usuario, $fecha);
    producto::sumar_productos($id_pro, $cantidad);

    quitar_cookie_cancelar($id_pedido);
}

function quitar_cookie_cancelar($id)
{
    setcookie('id_pedido' . $id, '', time() - 3600);
}
?>
<div id="historial">
    <section id="productos_historial">

       
</div>

</div>
<script>
    $(document).ready(function() {
        cargar();

        function cargar(pagina) {
            $.ajax({
                url: "./controlador/paginacion_productos_historial.php",
                method: "POST",
                data: {
                    pagina: pagina,
                    id : <?php echo $id_usuario?>
                },
                success: function(data) {
                    $("#productos_historial").html(data);
                }

            })
        }

        $(document).on('click', '.paginacion', function() {
            var pagina = $(this).attr("pagina");
            cargar(pagina);
        });
    });
</script>
<?php
require("./comunes/footer.php");
?>