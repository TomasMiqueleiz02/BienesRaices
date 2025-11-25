<?php
// Iniciar la sesión una sola vez para toda la aplicación
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require 'funciones.php';

require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';
use App\Propiedad;
$db = conectarDB();
Propiedad::setDB($db);

