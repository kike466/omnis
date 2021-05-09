<?php
require("clases/historial.php");
require("clases/pedidos.php");
require("clases/productos.php");
require("clases/usuario.php");
require("./comunes/header.php");


$id_usuario=1;


if (isset($_POST['cancelar'])) {
    $id_pro=$_POST['id_producto'];
    $cantidad=$_POST['cantidad_devolver'];
    $fecha=$_POST['fecha'];
    
    pedidos::cancelar_pedido($id_usuario,$fecha);
    producto::sumar_productos($id_pro,$cantidad);
    
}
?>
        <div id="historial">
            <section id="productos_historial">

                <?php
                if (historial::hay_historial_productos($id_usuario)=="1") {
                   
                        $productos=historial::historial_productos($id_usuario);
                        if (count($productos)>0) {
                            for ($i = 0; $i < count($productos); $i++) {
                                        
                                echo "<div class='contenedor_producto_historial'>";
        
                                    echo "<div class='nom_pun_st'>";
                                        echo "<div class='nombre'>".$productos[$i]['nombre_producto']."  ".$productos[$i]['precio']."€</div>";
                                        echo "<div class='puntuacion'>Puntuacion ".$productos[$i]['puntuacion']."/5</div>";
                                        echo "<div class='cantidad_comprada'>Cantidad comprada: ".$productos[$i]['cantidad']." productos</div>";
                                    echo " </div>";
        
                                    echo " <div class='imagen_producto'>";
                                        echo " <img class='img_producto' src='".$productos[$i]['ruta_Foto']."' alt='img/img_producto/interrogante-negro.png'>";
                                    echo"</div>";
        
                                    echo " <div class='descripcion_producto '>";
                                        echo " <p>".$productos[$i]['descripcion']."</p>";
                                    echo " </div>";
                                
                                    echo " <div class='btn_cancelar'>";
                                        
                                        echo "<form action=".$_SERVER["PHP_SELF"]." method='post'>";
                                        echo "<input type='hidden' name='cantidad_devolver' value=".$productos[$i]['cantidad'].">";
                                            echo "<input type='hidden' name='id_producto' value=".$productos[$i]['id_producto'].">";
                                            echo "<input type='hidden' name='fecha' value=".$productos[$i]['fecha_pedido'].">";
                                            echo "<input type='submit' value='Cancelar Pedido' id='cancelar' name='cancelar'>";
                                        echo "</form>";
                                    echo " </div>";
                                echo " </div>";
                    
                            }
                        }
                    }else {
                        echo "No hay productos";
                    }
                    
                ?>
        </div>

           

             
        

        <section id="pag">
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
        </section>
    </section>
</div>
<?php
require("./comunes/footer.php");
?>