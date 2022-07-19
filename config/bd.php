<?php
//este codigo realiza la declaración de variables
//que serán utilizadas en el index
$host = 'localhost'; //Estoy declarando variables
$username = 'root';//usuario de la base de datos
$password = '';//contrasena, en esye caso vacia ya que no tiene
$database = 'la_tiendita';//nombre de la base de datos

$connect = mysqli_connect($host,$username,$password, $database) or die('<p class="error">No se conecto al gestor.</p>');//Si on hay conexion a la base de datos se muestra un error

?>