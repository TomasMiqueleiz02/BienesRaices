<?php 
namespace App;

class Propiedad{
    //base de datos
    protected static $db;
    protected static $columnasDB= ['titulo','precio','imagen','descripcion','habitaciones','wc','estacionamientos','creado','vendedorId'];
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamientos;
    public $creado;
    public $vendedorId;

    //Errores
    protected static $errores =[];






    public function __construct($args=[])
        {
           $this ->id=$args ['id'] ?? '';
           $this ->titulo=$args ['titulo'] ?? '';
           $this ->precio=$args ['precio'] ?? '';
           $this ->imagen=$args ['imagen'] ?? '';
           $this ->descripcion=$args ['descripcion'] ?? '';
           $this ->habitaciones=$args ['habitaciones'] ?? '';
           $this ->wc=$args ['wc'] ?? '';
           $this ->estacionamientos=$args ['estacionamientos'] ?? '';
           $this ->creado=date('y/m/d');
           $this ->vendedorId=$args ['vendedorId'] ?? '';
        }
        //Definir la concexion a la base de datos
    public static function setDB($database){
        self::$db=$database;
    }
    public function guardar(){
        //sanitizar los datos
        $atributos = $this ->sanitizarAtributos();
      
        $columnas = join(', ',array_keys($atributos));
        $fila = join("', '",array_values($atributos));
        // debuguear($columnas);
        // debuguear($filas);
        
        //*  Consulta para insertar datos
        $query = "INSERT INTO propiedades($columnas) VALUES ('$fila')";
        $resultado=self::$db->query($query);
        return $resultado;
    }
    //Identificar y unir los atributos de la bd
    public function atributos(){
        $atributos =[];
        foreach(self::$columnasDB as $columna){
            if($columna === 'id')continue; //Linea para ignorar el id porque cuando creamos los atributos el id todavia no existe, se agrega a la bd autoamticamente
            $atributos [$columna]=$this->$columna;
        }
        return $atributos;
    }


    public function sanitizarAtributos(){
        $atributos=$this->atributos();
        $sanitizado=[];

        foreach($atributos as $key => $value ){ //Recorremos a ambos datos titulo y el valor del usuario
            $sanitizado[$key]= self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validacion
    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
         if(!$this->titulo){
        self::$errores []="Debes añadir un titulo";
        }
        if(!$this->precio){
        self::$errores []="Debes añadir un precio";
        }
          if(strlen($this->descripcion) < 20){
         self::$errores []="Debes añadir una descripcion y debe tener al menos 20 caracteres";
         }
         if(!$this->habitaciones){
         self::$errores []="Debes añadir un habitaciones";
         }
         if(!$this->wc){
         self::$errores []="Debes añadir un baño";
         }
         if(!$this->estacionamientos){
         self::$errores []="Debes añadir un estacionamiento";
         }
         if(!$this->vendedorId){
         self::$errores []="Debes añadir un vendedor";
         }
         if(!$this->imagen){
          self::$errores[]='La Imagen es obligatoria';
          }

        return self::$errores;

    }

    public function setImagen($imagen){
        if($imagen){
            $this->imagen=$imagen;
        }
    }

    //lista todas las propiedades
    public static function all(){
        $query="SELECT * FROM propiedades";
        // Usar consultarSQL para obtener los objetos y retornarlos
        return self::consultarSQL($query); 
    }

    public static function consultarSQL($query){
        //Consultar la base de datos
        $resultado=self::$db->query($query);

        //Iterar los resultados
        $array=[];
        while($registro=$resultado->fetch_assoc()){
            $array[]=self::crearObjeto($registro);
        }
        //Liberar la memoria del foreach de crearObjeto
        $resultado->free();
        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto=new self; //Crear una nueva instancia de la clase
        //Mapea el arreglo y lo pasa como objeto para poder acceder a sus propiedades Active Record
        //Se quedan unicamente en memoria para despues ser guardados en la base de datos
        foreach($registro as $key => $value){
            if (property_exists($objeto,$key)){
                $objeto->$key=$value;
            }
        }
        return $objeto;
    }
}