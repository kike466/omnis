<?php
require("clases/productos.php");
function validar($datos)
{
    $errores = array();

    if (empty(trim($datos['descripcion'])) || empty(trim($datos['precio'])) || empty(trim($datos['stock'])) || empty(trim($datos['nombre']))) {
        $errores[0] = "Algun campo esta vacio";
    }


    return $errores;
}

if (isset($_POST["Introducir"])) {

    $datos = validar($_POST);

    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];
    $nombre = $_POST["nombre"];



    if (empty($datos)) {

        $tmp_name = $_FILES['foto_Producto']['tmp_name'];
        $nombreF = $_FILES['foto_Producto']['name'];
        $carpeta = "./img/img_producto/";
        $tipo = $_FILES['foto_Producto']['type'];

        $nombreF = date("d-m-y-h-m-s", time()) . $nombreF;
        move_uploaded_file($tmp_name, $carpeta . $nombreF);

        $rutaFoto = $carpeta . $nombreF;



        producto::insertar_producto($nombre, $descripcion, $precio, $stock, $rutaFoto);
    }
}

require("./comunes/header.php");
?>
    <!-- inicio main -->
    <div id="añadirProductos" class="container-fluid">
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST" id="form_Productos" enctype="multipart/form-data">
            <div id="contenedor_producto_Añadir">

                <div id="imagen_producto_Añadir">
                    <div id="añadir_foto">
                        <p align="center">Añadir foto del producto</p>
                        
                    </div>
                    <div class=" input_form" id="file_foto_Producto">
                        <input type="file" name="foto_Producto" class="input_modi_foto">
                    </div>
                </div>
                <div id="nombre_producto_Añadir">
                    <div id="añadir_Nombre">
                        <p align="center">Nombre</p>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                </div>

                <div id="descripcion_producto_Añadir">
                    <div id="añadir_descripcion">
                        <p>Añadir descripcion del producto</p>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div id="precio_producto_Añadir">
                    <div id="añadir_precio">
                        <p align="center">Precio</p>
                        <input type="number" name="precio" id="precio">
                    </div>
                </div>
                <div id="stock_producto_Añadir">
                    <div id="añadir_Stock">
                        <p align="center">Stock</p>
                        <input type="number" name="stock" id="stock">
                    </div>
                </div>
                <div id="btn_Añadir"><input type="submit" name="Introducir" value="Añadir Producto" id="añadir_Producto"></div>
                <?php
                if (isset($_POST["Introducir"])) {
                    if (!empty($datos)) {
                        echo "<div style='width: 100%;'>";
                        echo "<p id='erroresRegistrar' style='color: red; text-align: center;'>";
                        foreach ($datos as $key => $value) {
                            echo $value . "<br>";
                        }
                        echo "</p>";
                        echo "</div>";
                    } else {
                        echo "<div style='width: 100%;'>";
                        echo "<p style='color: green; text-align: center;'>El producto ha sido añadido correctamente</p>";
                        echo "</div>";
                    }
                }

                
                ?>
            </div>

        </form>

    </div>

</body>

</html>