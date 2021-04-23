<?php
require("clases/usuario.php");
//require("lib/conexion.php");
 function redireccionar()
{

    header("Location: index.php");
    exit;
   
}

function validar($datos)
{
    $errores = array();

    if (empty(trim($datos['nombre'])) || empty(trim($datos['apellidos'])) || empty(trim($datos['provincia'])) || empty(trim($datos['codePostal'])) || empty(trim($datos['direccion'])) || empty(trim($datos['correo'])) || empty(trim($datos['pass1'])) || empty(trim($datos['passRe']))) {
        $errores[0] = "Algun campo esta vacio";
    }
    if ($datos['pass1'] != $datos['passRe']) {
        $errores[1] = "Las contraseñas no coinciden";
    }

    if (!empty($datos['correo'])) {
        $em = $datos['correo'];
        if (usuario::existe_correo($em)) {
            $errores[2] = "El correo ya existe";
        }
    }

    return $errores;
}

function validar2($datos)
{
    $errores2 = array();

    if (empty(trim($datos['correoIS'])) || empty(trim($datos['passIS']))) {
        $errores2[0] = "Algun campo esta vacio";
    }else {

        $correoIS = $datos['correoIS'];
        
        $passIS = $datos['passIS'];
        
        if (usuario::existe_correo($correoIS)) {
            if (!usuario::comprobamos_contraseña_correo($correoIS,$passIS)) {
                $errores2[2] = "La combinacion del email y la contraseña no existe";
            }
        }else {
            $errores2[1] = "El email no existe";
        }
        
    }
   
    return $errores2;
}


$nombre = "";
$apellidos = "";
$provincia = "";
$codPostal = "";
$direccion = "";
$email = "";
$pass = "";

if (isset($_POST["Registrarse"])) {

    $datos = validar($_POST);

    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $provincia = $_POST["provincia"];
    $codPostal = $_POST["codePostal"];
    $direccion = $_POST["direccion"];
    $email = $_POST["correo"];
    $pass = $_POST["pass1"];

    if (empty($datos)) {
        usuario::insertar_usuario($nombre, $apellidos, $provincia, $codPostal, $direccion, $email, $pass);
    }

     /* $conexion = conectarBD(); 

         

                $sql = "insert into usuario (nombre,apellidos,provincia,codePostal,direccion,email,password,tipo) values ('$nombre','$apellidos','$provincia','$codPostal','$direccion','$email','$pass','2')";

                
                $res = $conexion->query ($sql);
                if ($conexion->error!="") { 
                    echo "Error: La ejecución de la consulta falló debido a: \n"; 
                    echo "Query: " . $sql . "<br>\n"; 
                    echo "Errno: " . $conexion->errno . "<br>\n"; 
                    echo "Error: " . $conexion->error . "<br>\n"; 
                    exit; 
                } 
                
            */
}

$emailIS = "";
 $passIS = "";
            
if (isset($_POST["Entrar"])) {
            
    $datos2 = validar2($_POST);
            
    $emailIS = $_POST["correoIS"];
     $passIS = $_POST["passIS"];
            
    if (empty($datos2)) {
            
            $user =usuario::datos_usuario($emailIS);

            session_start();

            
         $_SESSION["nombre"] = $user["nombre"];
         $_SESSION["id"] = $user["id_usuarios"];
          $_SESSION["email"] = $user["email"];
         $_SESSION["direccion"] = $user["direccion"];
          $_SESSION["tipo"] = $user["tipo"];
            
         redireccionar();
                    
      }
            
                
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animacion.js"></script>

</head>


<body>
    <!-- fin header -->
    <!-- inicio main -->
    <div id="registrarse" class="container-fluid">

        <div id="contenedor_global_reg" class="row px-3">
            <div class="col-md-7 mx-auto">
                <div id="contenedor_2" class=" shadow rounded overflow-hidden">
                    <div class="cover1">
                        <div class=" pb-5 profile-head text-white">
                            <h4 id="titulo_form" class="d-flex justify-content-center">Registrarse</h4>
                            <form action="#" id="registrarse_form" method="POST">
                                <div id="datos" class="mx-auto mb-5 ">

                                    <div id="grupo__nombre" class="elemento_form">
                                        <div class="texto_form">Nombre:</div>
                                        <div class="input_form" id="">
                                            <input class="inputs_form" type="text" name="nombre" id="nombre" value="<?php echo $nombre;?>" placeholder="Enrique">
                                            <i class="validacion fas fa-times-circle"></i>


                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">El nombre tiene que ser de 2 a 30 caracteres puede contener letras , espacios y pueden llevar acentos.</p>
                                        </div>
                                    </div>
                                    <div id="grupo__apellidos" class="elemento_form">
                                        <div class="texto_form">Apellidos:</div>
                                        <div class="input_form"><input class="inputs_form" type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos;?>" placeholder="Martinez Galvañ">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">El apellido tiene que ser de 2 a 30 caracteres puede contener letras , espacios y pueden llevar acentos.</p>
                                        </div>
                                    </div>
                                    <div id="grupo__provincia" class="elemento_form">
                                        <div class="texto_form">Provincia:</div>
                                        <div class="input_form"><input class="inputs_form" type="text" name="provincia" id="provincia" value="<?php echo $provincia;?>" placeholder="Ingrese su Provincia">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">La provincia tiene que ser de 2 a 30 caracteres puede contener letras , espacios y pueden llevar acentos.</p>
                                        </div>
                                    </div>
                                    <div id="grupo__codePostal" class="elemento_form">
                                        <div class="texto_form">Codigo Postal:</div>
                                        <div class="input_form"><input class="inputs_form" type="text" name="codePostal" id="codePostal" value="<?php echo $codPostal;?>" placeholder="Ingrese su codigo postal">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">Tiene que tener 5 dígitos</p>
                                        </div>
                                    </div>

                                    <div id="grupo__direccion" class="elemento_form">
                                        <div class="texto_form">Direccion:</div>
                                        <div class="input_form"><input class="inputs_form" type="text" name="direccion" id="direccion" value="<?php echo $direccion;?>" placeholder="Ejemplo ejemplo nº10">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">1,2 o 3 palabras seguidas de un espacio con nº y el numero</p>
                                        </div>
                                    </div>
                                    <div id="grupo__correo" class="elemento_form">
                                        <div class="texto_form">Email:</div>
                                        <div class="input_form"><input class="inputs_form" type="email" name="correo" id="correo" value="<?php echo $email;?>" placeholder="ejemplo@gmail.com">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">Introducir un correo valido</p>
                                        </div>
                                    </div>
                                    <div id="grupo__pass1" class="elemento_form">
                                        <div class="texto_form">Contraseña:</div>
                                        <div class="input_form"><input class="inputs_form" type="password" name="pass1" id="pass1" placeholder="De 4 a 40 caracteres">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>
                                        <div class="contenedorErrorValidar">
                                            <p class="errorValidar">De 4 a 40 caracteres.</p>
                                        </div>
                                    </div>
                                    <div id="grupo__pass2" class="elemento_form">
                                        <div class="texto_form">Confirmar contraseña:</div>
                                        <div class="input_form"><input class="inputs_form" type="password" name="passRe" id="passRe" placeholder="Repita su Contraseña">
                                            <i class="validacion fas fa-times-circle"></i>
                                        </div>

                                    </div>
                                </div>

                                <div id="btn_registrar" class="mb-5 ">
                                    <input type="submit" value="Registrarse" name="Registrarse" id="registrar_cuenta">

<?php
        if (isset($_POST["Registrarse"])) {
            if (!empty($datos)) {
                    echo "<div style='width: 100%;'>";
                    echo "<p id='erroresRegistrar' style='color: red; text-align: center;'>";
                    foreach ($datos as $key => $value) {
                         echo $value."<br>";
                        }
                    echo "</p>";
                    echo "</div>";
             }else {
                    echo "<div style='width: 100%;'>";
                    echo "<p style='color: green; text-align: center;'>El usuario ha sido registrado correctamente</p>";
                    echo "</div>";
                 }
        }


?>
                                   
                                </div>

                                

                            </form>

                            <div id="enlace_reg" class="enlace"><a class="activar_animacion">¿Ya tengo
                                    Cuenta?</a></div>


                            <form action="" id="iniciar_Sesion_form" method="POST">
                                <div id="datos" class="mx-auto mb-5 ">

                                    <div id="emailIS" class="elemento_form">
                                        <div class="texto_form">Email:</div>
                                        <div class="input_form"><input class="inputs_form" type="email" name="correoIS" id="correoIS" value="<?php echo $emailIS;?>" placeholder="ejemplo@gmail.com">
                                        </div>

                                    </div>
                                    <div id="passIS" class="elemento_form">
                                        <div class="texto_form">Contraseña:</div>
                                        <div class="input_form"><input class="inputs_form" type="password" name="passIS" id="passIS"  placeholder="Ingrese su Contraseña">
                                        </div>

                                    </div>

                                </div>

                                <div id="btn_entrar" class="activar_animacion3 d-flex justify-content-center ">
                                    <input type="submit" value="Entrar" name="Entrar" id="inicio_sesion">

                                    <?php
                                    if (isset($_POST["Entrar"])) {

                                        if (!empty($datos2)) {
                                            
                                            echo "<div style='width: 100%;'>";
                                            echo "<p id='erroresEntrar' style='color: red; text-align: center;'>";
                                            foreach ($datos2 as $key => $value) {
                                                echo $value."<br>";
                                                }
                                            echo "</p>";
                                            echo "</div>";
                                        }else {
                                            echo "<div style='width: 100%;'>";
                                            echo "<p style='color: green; text-align: center;'>Has iniciado sesion correctamente</p>";
                                            echo "</div>";
                                        }
                                    }


                                    ?>

                                </div>


                            </form>



                        </div>
                    </div>
                    <div id="enlace_reg2" class="enlace">
                        <a class="activar_animacion2">Registrarse</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
    <!-- fin main -->
    <!-- inicio footer -->

</body>
<script src="js/validar_formulario.js"></script>

</html>