<?php

require_once("./conexion/conexion.php");

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

    public static function todos_los_datos_productos(){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from productos WHERE stock >0");
            for($i = 0; $i < $result->num_rows; $i++){
                $fila[$i] = $result->fetch_assoc();
            } 

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $fila;

    }
    public static function buscar_productos($nombre_productos){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from productos where nombre_producto like'%$nombre_productos%'");
            for($i = 0; $i < $result->num_rows; $i++){
                $fila[$i] = $result->fetch_assoc();
            } 

           

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $fila;

    }

    public static function restar_productos($id_productos){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select stock from productos where id_producto='$id_productos'");
            $fila = $result->fetch_assoc();
            $numero_de_productos= $fila['stock'];
            $numero_de_productos--;

            $conectar->query("UPDATE productos SET stock = '$numero_de_productos' WHERE id_producto = '$id_productos'");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        

    }

   
}

?>