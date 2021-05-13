<?php
require_once("../clases/conexion.php");

require("../clases/usuario.php");
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
    echo $correo;
    usuario::borrar_usuario($correo);
}

$conexion = conexion::abrir_conexion();



$productos_por_pagina = 5;
$salida = '';

if (isset($_POST['pagina'])) {
    $pagina = $_POST['pagina'];
    $pagina=intval($pagina);
} else {
    $pagina = 1;
}

$start = ($pagina - 1) * $productos_por_pagina;
$query = "SELECT nombre,email FROM usuario WHERE id_usuarios != 1 LIMIT $start,$productos_por_pagina";
$result = mysqli_query($conexion, $query);


while ($fila = mysqli_fetch_array($result)) {
    $salida .= '

    <div class="usuario">

    <section class="nombre_Email">
        <span class="nombre_Administrar">Nombre: '.$fila['nombre'].'</span>
        <span class="email_Administrar">Email: '.$fila['email'].'</span>
     </section>

     <section class="botones">
        <form action="" method="post" id="form_administrar">
            <input type="hidden" name="email" value="'.$fila['email'].'">
            <div class="hacer_admin"><input type="submit" value="Hacer Administrador" name="hacer_admin"></div>
            <div class="ascender_trabajador"><input type="submit" value="Hacer Trabajador" name="hacer_trabajador"></div>
            <div class="descender_usuario"><input type="submit" value="Hacer Usuario" name="hacer_usuario"></div>
            <div class="borrar_usuario"><input type="submit" value="Borrar Usuario" name="borrar"></div>
        </form>
     </section>
 </div>
                ';
}



$paginas_query = "SELECT nombre,email FROM usuario WHERE id_usuarios != 1";
$result = mysqli_query($conexion, $paginas_query);
$numero_de_filas = mysqli_num_rows($result);

$paginas_totales = ceil($numero_de_filas / $productos_por_pagina);

$salida .= "<div class='d-flex justify-content-center' style='width: 100%;'>";
$salida .= "<ul class='pagination justify-content-center'>";
$pag_siguiente=$pagina+1;
$pag_anterior=$pagina-1;

if ($pagina == 1) {

    $salida       .= '<li class="page-item disabled"><a class="page-link paginacion" pagina=' . 1 . '>&laquo;</a></li>';
} else {
    $salida       .= '<li><a class="page-link paginacion" pagina=' .$pag_anterior . '">&laquo;</a></li>';
}

for ($i = 1; $i <= $paginas_totales; $i++) {

    if ($pagina == $i) {
        $salida .= '<li class="page-item active" style="list-style:none;width:40px;cursor:pointer" ><a class="page-link paginacion" pagina=' . $i . '">' . $i . '</a></li>';
    } else {
        $salida .= '<li style="list-style:none;width:40px;cursor:pointer" ><a class="page-link paginacion" pagina=' . $i . '">' . $i . '</a></li>';
    }
}
if ($pagina == $paginas_totales) {

    $salida       .= '<li class="page-item disabled"><a class="page-link paginacion" pagina=' .$paginas_totales . '>&raquo;</a></li>';
} else {
    $salida       .= '<li><a class="page-link paginacion" pagina=' .$pag_siguiente . '">&raquo;</a></li>';
}

$salida .= "</ul>";
$salida .= "</div>";

echo $salida;
