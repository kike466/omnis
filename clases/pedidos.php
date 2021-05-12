<?php

require_once("conexionLocal.php");

class pedidos{

    private $id_pro;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $puntuacion;
    private $ruta_Foto;
    

    public static function insertar_pedido($id_usuarios,$id_producto,$cantidad,$fecha,$direccion,$cod_postal){


        $conectar = conexion::abrir_conexion();

        try{


            $conectar->query("insert into pedidos (id_usuarios,id_producto,cantidad,fecha_pedido,direccion,codePostal) values ('$id_usuarios','$id_producto','$cantidad','$fecha','$direccion','$cod_postal')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }

    public static function obtener_fecha(){

        $fecha = date("Y-m-d_H:i:s");

        return $fecha;
 
    }
    

    public static function cancelar_pedido($id_usuarios,$fecha){


        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("DELETE FROM pedidos WHERE (pedidos.id_usuarios='$id_usuarios') AND (pedidos.fecha_pedido='$fecha')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }
    public static function obtener_pedido($id_usr,$fecha){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("SELECT pedidos.id_pedido FROM pedidos WHERE pedidos.id_usuarios='$id_usr' AND pedidos.fecha_pedido='$fecha'");
            $fila = $result->fetch_assoc();

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $fila;

    }

   
}

?>