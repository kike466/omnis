<?PHP
$servidor="localhost";
$usuario="root";
$password="";
$bd="omnis";

function conectarBD(){
  global $servidor,$usuario,$password,$bd;
  $conexion = new mysqli($servidor,$usuario,$password,$bd);
  if ($conexion->connect_errno) {
  	echo "Error: Fallo al conectarse a MySQL debido a: \n"; 
  	echo "Errno: " . $conexion->connect_errno . "\n";
  	echo "Error: " . $conexion->connect_error . "\n";
  	exit;
  }
         
  $conexion->set_charset("utf8");
  return $conexion;
}

function desconectarBD($conexion){
  $conexion->close();
}


Class Conexion{

	public static function conectarBD(){
		$server="localhost";
		$usr="root";
		$pass="";
		$bd="chat";
		$mysqli = new mysqli($server, $usr, $pass, $bd); 
		if ($mysqli->connect_errno) { 
			echo "Error: Fallo al conectarse a MySQL debido a: \n"; 
			echo "Errno: " . $mysqli->connect_errno . "\n"; 
			echo "Error: " . $mysqli->connect_error . "\n"; 
			exit;
		}
		$mysqli->set_charset("utf8");
		return $mysqli;
	}

	public static function desconectarBD($mysqli){
  		$mysqli->close();
	}
}



?>