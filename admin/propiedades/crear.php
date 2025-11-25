<?php
  require '../../includes/app.php';


  use App\Propiedad;
  use Intervention\Image\Drivers\Gd\Driver;
  use Intervention\Image\ImageManager as Image;

  estaAutenticado();

 $db=conectarDB();
 incluirTemplate('header');

 //Consultar para obretenr los vendedors
 $consulta="SELECT * FROM vendedores";
 $resultadoVendedores=mysqli_query($db,$consulta);

 //Arreglo con mensajes de errores
 $errores=Propiedad::getErrores();

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
    $propiedad = new Propiedad($_POST);

   $nombreImagen=md5( uniqid(rand(),true) ). ".jpg"; //Generamos nombres unicos asi las imagens no se reescriben en la carpetya
   if ($_FILES['imagen']['tmp_name']){
    $manager= new Image(Driver::class);
    $imagen=$manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);//Metodos de ImageManager Intervetion.io
    $propiedad->setImagen($nombreImagen);
   }

    $errores=$propiedad->validar();
    

 if (empty($errores)){

    // Subida de archivos
    // Crear carpeta
    
    if(!is_dir(CARPETA_IMAGENES)){
      mkdir(CARPETA_IMAGENES);
    }

    //Guardar la imagen en el servidor
    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
   $resultado= $propiedad->guardar();
   if($resultado){
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

                        <select name="vendedorId">
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

