<?php

require("../clases/productos.php");

switch ($_REQUEST["op"]) {
    case 'listar_productos':
            $datos=producto::todos_los_datos_productos();
            $productos=Array();
            for ($i=0; $i <count($datos) ; $i++) { 
               
            $productos[]=array(
                "0"=>$datos[$i]['id_producto'],
                "1"=>$datos[$i]['nombre_producto'],
                "2"=>$datos[$i]['descripcion'],
                "3"=>$datos[$i]['precio'],
                "4"=>$datos[$i]['stock'],
                "5"=>$datos[$i]['puntuacion']
                
            );
        }

            $resultados=array(
                    "sEcho" =>1,
                    "iTotalRecords" =>count($productos),
                    "iTotalDisplayRecords" =>count($productos),
                    "aaData" =>$productos
            );

            echo json_encode($resultados);
        break;
    
   
}





