<?php
//importar conexion
require 'includes/app.php';
$db=conectarDB();

//crear email pasword
$email="corrro@correo.com";
$password="123456";
//hashear pasword
$passwordHash=password_hash($password,PASSWORD_DEFAULT);

//query para el usuario

$query= "INSERT INTO usuarios (email,password)VALUES('$email','$passwordHash')";

// echo $query;


// Agregarlo a la base de datos
mysqli_query($db,$query);