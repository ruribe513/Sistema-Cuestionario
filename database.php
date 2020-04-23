<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'php_login_database';

$conection = @mysqli_connect($host,$user,$password,$db);

if (!$conection) {
  echo "Error en la conexion";
}
 ?>
