<?php

require_once("./conexion/conexionLocal.php");

class usuario
{

    private $id_usr;
    private $nombre;
    private $apellidos;
    private $email;
    private $provincia;
    private $codPostal;
    private $direccion;
    private $pass;
    private $tipo;

    function __construct($id_usr)
    {
        $this->$id_usr = $id_usr;
    }
    public function obtener_id_Usuario()
    {
        return $this->id_usr;
    }

    public static function datos_usuario($correo)
    {

        $conectar = conexion::abrir_conexion();

        try {

            $result = $conectar->query("Select * from usuario where email = '$correo'");
            $fila = $result->fetch_assoc();
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();

        return $fila;
    }

    public static function insertar_usuario($nombre, $apellidos, $provincia, $codPostal, $direccion, $email, $pass)
    {



        $conectar = conexion::abrir_conexion();

        try {

            $conectar->query("insert into usuario (nombre,apellidos,provincia,codePostal,direccion,email,password,tipo) values ('$nombre','$apellidos','$provincia','$codPostal','$direccion','$email','$pass','3')");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }

    public static function existe_correo($email)
    {

        $conectar = conexion::abrir_conexion();

        try {

            $result = $conectar->query("Select * from usuario where email = '$email'");
            $result = $result->num_rows;

            if ($result >= 1) {

                $conectar->close();
                return true;
            } else {

                $conectar->close();
                return false;
            }
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }
    }
    public static function comprobamos_contraseña_correo($correo, $contraseña)
    {

        $conectar = conexion::abrir_conexion();

        try {

            $result = $conectar->query("Select email,password from usuario where email = '$correo'");
            $fila = $result->fetch_assoc();


            if ($fila["email"] == $correo && $fila["password"] == $contraseña) {

                $conectar->close();
                return true;
            } else {

                $conectar->close();
                return false;
            }
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }
    }



    public static function nombre_email()
    {

        $conectar = conexion::abrir_conexion();

        try {

            $result = $conectar->query("SELECT nombre,email FROM usuario");
            for ($i = 0; $i < $result->num_rows; $i++) {
                $fila[$i] = $result->fetch_assoc();
            }
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();

        return $fila;
    }
    public static function hacer_admin($correo)
    {

        $usuario = usuario::datos_usuario($correo);
        $id_usr = $usuario["id_usuarios"];

        $conectar = conexion::abrir_conexion();

        try {

            $conectar->query("Update usuario set tipo = '1' where id_usuarios = $id_usr");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }
    public static function hacer_trabajador($correo)
    {

        $usuario = usuario::datos_usuario($correo);
        $id_usr = $usuario["id_usuarios"];

        $conectar = conexion::abrir_conexion();

        try {

            $conectar->query("Update usuario set tipo = '2' where id_usuarios = $id_usr");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }
    public static function hacer_usuario($correo)
    {

        $usuario = usuario::datos_usuario($correo);
        $id_usr = $usuario["id_usuarios"];

        $conectar = conexion::abrir_conexion();

        try {

            $conectar->query("Update usuario set tipo = '3' where id_usuarios = $id_usr");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }
    public static function borrar_usuario($correo)
    {

        $usuario = usuario::datos_usuario($correo);
        $id_usr = $usuario["id_usuarios"];

        $conectar = conexion::abrir_conexion();

        try {

            $conectar->query("Delete from usuario where id_usuarios = '$id_usr'");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }

    public static function actualizar_usuario($provincia,$codePostal,$direccion,$correo,$pass,$id)
    {

        $conectar = conexion::abrir_conexion();


        try {

            $conectar->query(" UPDATE usuario SET provincia = '$provincia', codePostal=$codePostal, direccion='$direccion', email='$correo', password=$pass WHERE id_usuarios=$id");
        } catch (exception $e) {

            die("Error: " . $e->getMessage());
        }

        $conectar->close();
    }


   
}
