<?php

use Pdo\Mysql;

require 'includes/app.php';
$db=conectarDB();
//Autenticar el usuario
$errores=[];

if ($_SERVER['REQUEST_METHOD']==='POST'){ //Es para leer el post
    //Asignamos valores del form aca
    $email=mysqli_real_escape_string($db, filter_var($_POST['email'],FILTER_VALIDATE_EMAIL));//validamos q entre un email

    $password=mysqli_real_escape_string($db,$_POST['password']);

    if(!$email){
        $errores[]="El email es obligatorio o no es valido";
    }
    if(!$password){
        $errores[]="El password es obligatorio";
    }

    if(empty($errores)){
        //revisar si el usuario existe
        $query="SELECT * FROM usuarios WHERE email = '$email'"; //Validamos que existe el email con el string del email en la BD

        $resultado=mysqli_query($db,$query);

       if($resultado -> num_rows){ //num rows permite saber si existe un registro
        //Revisamos si el password es correcto
        $usuario=mysqli_fetch_assoc($resultado);

        //Verificar si el psw es correcto o no

        $auth=password_verify($password,$usuario['password']);
        
        if($auth){
            //El usuario esta autenticado
            session_start();

            //Llenar el arreglo de la session
            $_SESSION['usuario']=$usuario['email'];
            $_SESSION['login']=true;

            header('Location: /admin');

        } else{
            $errores[]="El password es Incorrecto";
        }
       }else{
        $errores[]="El usuario no existe";
       } 
    }
}


//Incluye el header

incluirTemplate('header');

?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>
        <?php foreach($errores as $error):?>
            <div class="alerta error">
               <?php echo $error; ?> 
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" >

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">

            </fieldset>
            <input type="submit" value="Iniciar Sesion" class="boton-verde">   
        </form>
    </main>

<?php 
    incluirTemplate('footer');
?>

