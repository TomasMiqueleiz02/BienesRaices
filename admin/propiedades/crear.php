<?php
  require '../../includes/funciones.php';
    session_start();

    $auth=$_SESSION['login'];

    if(!$auth){
        header('Location: /') ;
      }  
require '../../includes/config/database.php';

 $db=conectarDB();
 incluirTemplate('header');

 //Consultar para obretenr los vendedors
 $consulta="SELECT * FROM vendedores";
 $resultadoVendedores=mysqli_query($db,$consulta);

 //Arreglo con mensajes de errores
 $errores=[];

 //Realizamos estos strings vacios para que si el usuario no pase una validacion no se borren las demas
 $titulo = '';
 $precio = '';
 $descripcion ='' ;
 $habitaciones =''; 
 $wc = '';
 $estacionamientos=''; 
 $vendedorId = '';


//Ejecutar el codigo despues de que el usuario envia el formulario
if($_SERVER ['REQUEST_METHOD']=== 'POST'){ 
  


 

 $titulo =mysqli_real_escape_string($db, $_POST['titulo'] );
 $precio =mysqli_real_escape_string($db, $_POST['precio'] );
 $descripcion =mysqli_real_escape_string($db, $_POST['descripcion']);
 $habitaciones =mysqli_real_escape_string($db, $_POST['habitaciones']);
 $wc =mysqli_real_escape_string($db, $_POST['wc']);
 $estacionamientos=mysqli_real_escape_string($db, $_POST['estacionamientos']);
 $vendedorId =mysqli_real_escape_string($db, $_POST['vendedor']);
 $creado =  date('y/m/d');
 
 //Asignar files hacia una variable
 $imagen =$_FILES['imagen'];
 



 if(!$titulo){
   $errores []="Debes añadir un titulo";
 }
 if(!$precio){
   $errores []="Debes añadir un precio";
 }
 if(strlen($descripcion) < 20){
   $errores []="Debes añadir una descripcion y debe tener al menos 20 caracteres";
 }
 if(!$habitaciones){
   $errores []="Debes añadir un habitaciones";
 }
 if(!$wc){
   $errores []="Debes añadir un baño";
 }
 if(!$estacionamientos){
   $errores []="Debes añadir un estacionamiento";
 }
 if(!$vendedorId){
   $errores []="Debes añadir un vendedor";
 }
 if(!$imagen['name']){
  $errores[]='La Imagen es obligatoria';
 }
 //Validar x tamaño la imagen
 $medida=1000*1000; //Pasar de bytes a kilobites

 if($imagen['size']>$medida || $imagen ['error']){
  $errores []='La imagen es muy pesada';
 }



 if (empty($errores)){
    // Subida de archivos
    // Crear carpeta
    $carpetaImagenes= '../../imagenes/';
    if(!is_dir($carpetaImagenes)){
      mkdir($carpetaImagenes);
    }

    //Generar un nombre unico
    $nombreImagen=md5( uniqid(rand(),true) ). ".jpg"; //Generamos nombres unicos asi las imagens no se reescriben en la carpetya





    //subir la imagen

    move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen) ;
    




   // insertar en la base de datos
 $query= "INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,estacionamientos,creado,vendedorId) VALUES ('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamientos','$creado','$vendedorId')";

  $resultadoInsert=mysqli_query($db,$query); //Para pasar el query a la bd

  if($resultadoInsert){
    //redireccionar al usuario para que no ponga datos duplicados
    header('Location: /admin?resultado=1');
  }

 }





}
  
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>
                <a href="/admin" class="boton boton-verde">Volver</a>
                <?php foreach($errores as $error ): ?>
                  <div class="alerta error">
                    <?php echo $error; ?>
                  </div>
                  
                <?php endforeach; ?>


                <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data"><!--Enctype para subir archivos de imagen-->
                    <fieldset>
                        <legend>Informacion General</legend>

                        <label for="titulo">Titulo :</label>
                        <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo;?>">


                        <label for="precio">Precio :</label>
                        <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">


                        <label for="imagen">Imagen</label>
                        <input type="file" id="imagen" accept="image/jpeg , image/png" name="imagen">

                        <label for="descripciot">Descripcion</label>
                        <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>

                      </fieldset>
                      <fieldset>
                        <legend>Informacion Propiedad</legend>
                        
                        <label for="habitaciones">Habitacines:</label>
                        <input type="number" id="habitaciones" name="habitaciones" placeholder="ej:3" min="1" max="9" value="<?php echo $habitaciones;?>">


                        <label for="wc">Baños:</label>
                        <input type="number" id="wc" name="wc" placeholder="ej:3" min="1" max="9" value="<?php echo $wc;?>">


                        <label for="estacionamientos">Estacionamiento:</label>
                        <input type="number" id="estacionamientos" name="estacionamientos" placeholder="ej:3" min="1" max="9" value="<?php echo $estacionamientos;?>">

                        
                      </fieldset>

                      <fieldset>
                        <legend>Vendedor</legend>

                        <select name="vendedor">
                            <option value="">--Seleccione--</option>
                            <?php while($vendedor= mysqli_fetch_assoc($resultadoVendedores)): ?>
                              <option <?php echo $vendedorId === $vendedor ['id'] ? 'selected': " "  ?> value="<?php echo $vendedor ['id'];?>"><?php echo $vendedor ['nombre']. " ". $vendedor['apellido']; ?> </option>
                            <?php endwhile; ?>

                        </select>
                      </fieldset>

                      <input type="submit" value="Crear Propiedad" class="boton boton-verde">


                </form>
    </main>

<?php 
    incluirTemplate('footer');
?>

