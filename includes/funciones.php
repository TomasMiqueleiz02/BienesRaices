<?php


define('TEMPLEATES_URL', __DIR__.'/templeates');
define('FUNCIONES_URL', __DIR__.'/funciones.php');


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLEATES_URL . "/{$nombre}.php";
}

function estaAutenticado():bool{
    session_start();

    $auth=$_SESSION['login'];

    if(!$auth){
        return true;
       
    }
    return false;
}