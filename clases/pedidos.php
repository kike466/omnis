<?php

require_once("./conexion/conexion.php");

class pedidos{

    private $id_pro;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $puntuacion;
    private $ruta_Foto;
    

    public static function insertar_pedido($id_usuarios,$id_producto){


        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("insert into pedidos (id_usuarios,id_producto) values ('$id_usuarios','$id_producto')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }

   

   
}

?>