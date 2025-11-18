<?php 
require 'includes/app.php';
incluirTemplate('header');
//Importar la conexion

$db=conectarDB();

// Validar el id por GET
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    // Redirigir si no hay un id válido
    header('Location: /');
    exit;
}

//Consultar
$query="SELECT * FROM propiedades WHERE id=$id";


//Obetener los resultados
$resultado=mysqli_query($db,$query);

?>
    <main class="contenedor seccion contenido-centrado">
        <?php while ($propiedad=mysqli_fetch_assoc($resultado)): ?>
        <h1><?php echo $propiedad ['titulo'];?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad ['imagen'];?>" alt="anuncio">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad ['precio'];?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad ['wc'];?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad ['estacionamientos'];?></p>
                </li>
                <li>
                    <img class="icono"  loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                    <p><?php echo $propiedad ['habitaciones'];?></p>
                </li>
            </ul>
            <p><?php echo $propiedad ['descripcion'];?></p>
            
        </div>
     <?php endwhile; ?>
    </main>

<?php 
    incluirTemplate('footer');
?>

