<?php

require("./conexion/conexionLocal.php");

class producto{

    private $id_pro;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $puntuacion;
    private $ruta_Foto;
    

    public static function insertar_producto($nombre_producto,$descripcion,$precio,$stock,$ruta_Foto){


        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("insert into productos (nombre_producto,descripcion,precio,stock,puntuacion,ruta_Foto) values ('$nombre_producto','$descripcion','$precio','$stock','0','$ruta_Foto')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }

   
}

?>