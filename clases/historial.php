<?php

require_once("conexionLocal.php");

class historial{

    private $id_pro;
    private $id_usr;
    
    


    public static function hay_historial_productos($id_usuarios){

        $conectar = conexion::abrir_conexion();

        try{
            
            $result = $conectar->query("SELECT IF (EXISTS(SELECT * FROM productos p INNER JOIN pedidos pe ON pe.id_producto=p.id_producto INNER JOIN usuario u ON u.id_usuarios=pe.id_usuarios WHERE u.id_usuarios='$id_usuarios'),1,0)AS existe");
            $fila = $result->fetch_assoc();
            $existe=$fila['existe'];
                
            

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $existe;

    }

    
    public static function historial_productos($id_usuarios){

        $conectar = conexion::abrir_conexion();

        try{
            
            $result = $conectar->query("SELECT * FROM productos p INNER JOIN pedidos pe ON pe.id_producto=p.id_producto INNER JOIN usuario u ON u.id_usuarios=pe.id_usuarios WHERE u.id_usuarios='$id_usuarios'");
            for($i = 0; $i < $result->num_rows; $i++){
                $fila[$i] = $result->fetch_assoc();
            } 

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $fila;

    }

   

   
}

?>