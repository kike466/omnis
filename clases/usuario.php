<?php

require("./conexion/conexion.php");

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

        echo"shgoudszbviuzsviuuhvuib";

        $conectar = conexion::abrir_conexion();

        try{

            $conectar->query("insert into usuario (nombre,apellidos,provincia,codePostal,direccion,email,password,tipo) values ('$nombre','$apellidos','$provincia','$codPostal','$direccion','$email','$pass','2')");

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }

        $conectar->close();
 
    }


}

?>