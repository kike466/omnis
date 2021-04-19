<?php

class conexion{

    private static $host = "host eu-cdbr-west-01.cleardb.com";
    private static $user = "b8fb8998d6289a";
    private static $pass = "5db52478";
    private static $database ="heroku_3c62ffd81ce121e";
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