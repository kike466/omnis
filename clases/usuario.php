<?php

require_once("./conexion/conexionLocal.php");

class usuario{

    private $id_usr;
    private $nombre;
    private $apellidos;
    private $email;
    private $provincia;
    private $codPostal;
    private $direccion;
    private $pass;
    private $tipo;

    public static function insertar_usuario($nombre,$apellidos,$provincia,$codPostal,$direccion,$email,$pass){

        

        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("insert into usuario (nombre,apellidos,provincia,codePostal,direccion,email,password,tipo) values ('$nombre','$apellidos','$provincia','$codPostal','$direccion','$email','$pass','2')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }

    public static function existe_correo($email){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from usuario where email = '$email'");
            $result = $result->num_rows;

            if($result >= 1){

                $conectar->close();
                return true;

            } else {

                $conectar->close();
                return false;

            }

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

    }
    public static function comprobamos_contraseña_correo($correo,$contraseña){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select email,password from usuario where email = '$correo'");
            $fila = $result->fetch_assoc();
            

            if($fila["email"] == $correo && $fila["password"] == $contraseña){

                $conectar->close();
                return true;

            } else {

                $conectar->close();
                return false;                

            }

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

    }
    public static function datos_usuario($correo){

        $conectar = conexion::abrir_conexion();

        try{

            $result = $conectar->query("Select * from usuario where email = '$correo'");
            $fila = $result->fetch_assoc();

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();

        return $fila;

    }


}

?>