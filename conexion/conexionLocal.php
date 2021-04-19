<?php

class conexion{

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $database ="omnis";
    private static $conexion;

    public static function abrir_conexion(){

        try{

            self::$conexion = new mysqli(self::$host,self::$user,self::$pass,self::$database);

        } catch(exception $e){

            die("Error: " . $e->getMessage());

        }
        return self::$conexion;
    }

}

?>