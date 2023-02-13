<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	
} 
else {
	header("Location: forbidden.html");
	exit(1);  // sin mensaje.
	}
	
 $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
if( isset($_POST['name']) && isset($_POST['email']) )
        {
            // Nombre:
             if( empty($_POST['name']) )  {
				echo'<script type="text/javascript">
        alert("Tarea Guardada");
        window.location.href="index.php";
        </script>';
				 header("Location: index.html");
	             exit(1);
                
            }else{
       
                
                 if( preg_match($patron_texto, $_POST['name']) ){
                    $aMensajes[] = "Nombre: [".$_POST['name']."]";
               } else{
                    
				echo '<script language="javascript">alert("El nombre sólo puede contener letras y espacios");</script>';
				 header("Location: index.html");
	             exit(1);

            }
			}
			
			if( empty($_POST['email']) ){
				echo '<script language="javascript">alert("El email no puede estar vacio");</script>';
				 header("Location: index.html");
	             exit(1);
                
            }else{
            

            }
			}

?>



	
<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];
function sistemaoperativo($user_agent) {
   $plataformas = array(
      'Windows 10' => 'Windows NT 10.0+',
      'Windows 8.1' => 'Windows NT 6.3+',
      'Windows 8' => 'Windows NT 6.2+',
      'Windows 7' => 'Windows NT 6.1+',
      'Windows Vista' => 'Windows NT 6.0+',
      'Windows XP' => 'Windows NT 5.1+',
      'Windows 2003' => 'Windows NT 5.2+',
      'Windows' => 'Windows otros',
      'iPhone' => 'iPhone',
      'iPad' => 'iPad',
      'Mac OS X' => '(Mac OS X+)|(CFNetwork+)',
      'Mac otros' => 'Macintosh',
      'Android' => 'Android',
      'BlackBerry' => 'BlackBerry',
      'Linux' => 'Linux',
   );
   foreach($plataformas as $plataforma=>$pattern){
      if (preg_match('/(?i)'.$pattern.'/', $user_agent))
         return $plataforma;
   }
   return 'Otras';
}

$os_platform = sistemaoperativo($user_agent);












function navegador($user_agent){

if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
   return 'Microsoft Edge';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera Mini";
 elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'No hemos podido detectar su navegador';


}
$browser = navegador($user_agent);
 
$servername = "localhost";
$database = "suscribers";
$username = "luke_user";
$password = "password_luke_D*EWiD4lnc";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 

 
# Para obtener la fecha correcta hay que poner la zona horaria
date_default_timezone_set("America/Argentina/Buenos_Aires");

$fecha = date("Y-m-d H:i:s");



//Ip del visitante
if ($_SERVER['REMOTE_ADDR']=='::1') $ipuser= ''; else $ipuser= $_SERVER['REMOTE_ADDR'];



$_SERVER['HTTP_CLIENT_IP'];

$geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ipuser) );




$pais = $geoPlugin_array['geoplugin_countryName'];
$ciudad = $geoPlugin_array['geoplugin_city'];
$continente = $geoPlugin_array['geoplugin_continentCode'];
$moneda = $geoPlugin_array['geoplugin_currencyCode'];












$nombre = $_POST['name']; 
$correo = $_POST['email'];

$sql = "INSERT INTO datos (Nombre, Correo, Continente, Pais,Ciudad,Fecha,ip,Sistema,Navegador,Moneda) VALUES ('$nombre', '$correo','$continente', '$pais','$ciudad','$fecha','$ipuser','$os_platform','$browser','$moneda')";



	

if (mysqli_query($conn, $sql)) {
      
	$mensaje = sprintf("%s  Se suscribio el %s%s   Pais %s   Ciudad de   %s   OS   %s    browser   %s    Con direccion IP: %s",$nombre, $fecha, $pais, $ciudad, $os_platform,$browser, $ipuser, PHP_EOL);	  
    file_put_contents("logs.txt", $mensaje, FILE_APPEND);   
         
} else {
     header("Location: suscribe-failed.php");
	 mysqli_close($conn);
	 exit(1);  // sin mensaje.
	 
}
mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
<body>
<form name="envia" method="post" action="suscribe.php">
<input type="hidden" name="vienedeinsert" value="si">
</form>
<script language="JavaScript">
document.envia.submit()
</script>";



</body>




</html>



























