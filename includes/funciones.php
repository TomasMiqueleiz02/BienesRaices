<?php


define('TEMPLEATES_URL', __DIR__.'/templeates');
define('FUNCIONES_URL', __DIR__.'/funciones.php');
define('CARPETA_IMAGENES', __DIR__.'/../imagenes/');


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLEATES_URL . "/{$nombre}.php";
}

function estaAutenticado(){
    // Asegurar que la sesión esté iniciada (si no fue iniciada en app.php)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si no existe la sesión de login o es false, redirigir al inicio
    if (!isset($_SESSION['login']) || !$_SESSION['login']){
        header('Location: /');
        exit;
    }

}

function debugear($variable){
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;

}