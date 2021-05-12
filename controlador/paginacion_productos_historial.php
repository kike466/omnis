<?php
require_once("../clases/conexion.php");

$conexion = conexion::abrir_conexion();



$productos_por_pagina = 3;
$salida = '';

if (isset($_POST['pagina'])) {
    $pagina = $_POST['pagina'];
} else {
    $pagina = 1;
}

if (isset($_POST['id'])) {
    $id_usuarios = $_POST['id'];
}

$start = ($pagina - 1) * $productos_por_pagina;
$query = "SELECT * FROM productos p INNER JOIN pedidos pe ON pe.id_producto=p.id_producto INNER JOIN usuario u ON u.id_usuarios=pe.id_usuarios WHERE u.id_usuarios='$id_usuarios' LIMIT $start,$productos_por_pagina";
$result = mysqli_query($conexion, $query);


while ($fila = mysqli_fetch_array($result)) {
    $salida .= '
    <div class="contenedor_producto_historial">
        
    <div class="nom_pun_st">
        <div class="nombre">' . $fila["nombre_producto"] . '  ' . $fila["precio"] . '€</div>
        <div class="puntuacion">Puntuacion "' . $fila['puntuacion'] . '/5</div>
        <div class="cantidad_comprada">Cantidad comprada: ' . $fila['cantidad'] . ' productos</div>
     </div>

     <div class="imagen_producto">
         <img class="img_producto" src="' . $fila['ruta_Foto'] . '" alt="img/img_producto/interrogante-negro.png">
    </div>

     <div class="descripcion_producto ">
         <p>' . $fila["descripcion"] . '</p>
     </div>

     <div class="btn_cancelar">
        
        <form action="' . $_SERVER["PHP_SELF"] . '" method="post">
        <input type="hidden" name="cantidad_devolver" value="' . $fila['cantidad'] . '">
            <input type="hidden" name="id_producto" value="' . $fila['id_producto'] . '">
            <input type="hidden" name="fecha" value="' . $fila['fecha_pedido'] . '">
            <input type="hidden" name="id_pedido" value="' . $fila['id_pedido'] . '">
            ';
    $id = $fila["id_pedido"];

    if (isset($_COOKIE["id_pedido" . $id])) {
        $salida .= '<input type="submit" value="Cancelar Pedido" id="cancelar" name="cancelar">';
    }

    $salida .=
        '       </form>
                </div>
            </div>
                        

                ';
}



$paginas_query = "SELECT * FROM productos p INNER JOIN pedidos pe ON pe.id_producto=p.id_producto INNER JOIN usuario u ON u.id_usuarios=pe.id_usuarios WHERE u.id_usuarios='$id_usuarios'";
$result = mysqli_query($conexion, $paginas_query);
$numero_de_filas = mysqli_num_rows($result);

$paginas_totales = ceil($numero_de_filas / $productos_por_pagina);

$salida .= "<div class='d-flex justify-content-center' style='width: 100%;'>";
$salida .= "<ul class='pagination justify-content-center'>";

if ($pagina == 1) {

    $salida       .= '<li class="page-item disabled"><a class="page-link paginacion" pagina=' . 1 . '>&laquo;</a></li>';
} else {
    $salida       .= '<li><a class="page-link paginacion" pagina=' . ($pagina - 1) . '">&laquo;</a></li>';
}

for ($i = 1; $i <= $paginas_totales; $i++) {

    if ($pagina == $i) {
        $salida .= '<li class="page-item active" style="list-style:none;width:40px;cursor:pointer" ><a class="page-link paginacion" pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        $salida .= '<li style="list-style:none;width:40px;cursor:pointer" ><a class="page-link paginacion" pagina=' . $i . '">' . $i . '</a></li>';
    }
}
if ($pagina == $paginas_totales) {

    $salida       .= '<li class="page-item disabled"><a class="page-link paginacion" pagina=' . $paginas_totales . '>&raquo;</a></li>';
} else {
    $salida       .= '<li><a class="page-link paginacion" pagina=' . ($pagina + 1) . '">&raquo;</a></li>';
}

$salida .= "</ul>";
$salida .= "</div>";

echo $salida;
