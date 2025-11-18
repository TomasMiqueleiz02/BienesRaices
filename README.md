<h1 align="center">🏠 Bienes Raíces - Proyecto Web</h1>



<p align="center">

<img src="https://www.google.com/search?q=https://img.shields.io/badge/PHP-777BB4%3Fstyle%3Dfor-the-badge%26logo%3Dphp%26logoColor%3Dwhite" alt="PHP" />

<img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />

<img src="https://www.google.com/search?q=https://img.shields.io/badge/SASS-CC6699%3Fstyle%3Dfor-the-badge%26logo%3Dsass%26logoColor%3Dwhite" alt="SASS" />

<img src="https://www.google.com/search?q=https://img.shields.io/badge/Gulp-CF4647%3Fstyle%3Dfor-the-badge%26logo%3Dgulp%26logoColor%3Dwhite" alt="Gulp" />

</p>



<p align="center">

<strong>Aplicación web para la gestión y visualización de propiedades inmobiliarias.</strong>

</p>



# 📖 Descripción



Este proyecto es una aplicación web completa desarrollada con PHP y MySQL. Implementa herramientas modernas como SASS y Gulp para la optimización, compilación y minificación de los estilos y scripts del frontend.



# 📋 Características Principales



🔹 Página Pública



  Visualización: Catálogo de propiedades con diseño atractivo.

  

  Secciones: Blog, página de "Nosotros" y formulario de "Contacto".



🔹 Panel de Administración (CRUD):



  Propiedades: Gestión completa (Crear, Leer, Actualizar, Eliminar).

  

  Vendedores: Gestión de la información de los agentes.

  

  Multimedia: Subida y procesado de imágenes para cada propiedad.





# 🔒 Seguridad



   Validación estricta de formularios.

   

   Uso de Prepared Statements (Consultas Preparadas) para prevenir inyección SQL.

   

   Sistema de autenticación de usuarios hash.



   



# 🛠 Tecnologías Utilizadas  



   Backend: PHP, MySQL.

  

   Frontend: HTML5, SCSS (SASS), JavaScript.



   



Herramientas:



  NPM & Gulp: Automatización de tareas (compilación de SASS, minificación de scripts).



# 🚀 Guía de Instalación

   Sigue estos pasos para desplegar el proyecto en tu entorno local (XAMPP, MAMP, WAMP, etc.).



  1. Clonar el repositorio 

     Descarga el proyecto en tu carpeta de servidor (ej. htdocs o www).

     

         git clone [https://github.com/TomasMiqueleiz02/BienesRaices.git](https://github.com/TomasMiqueleiz02/BienesRaices.git)









  3. Instalar dependencias

     Frontend (Node.js):

     Ejecuta el siguiente comando para instalar Gulp y las herramientas de estilos:

     

         npm install











  4. Base de Datos (Importante) ⚠️

     

     🔹El archivo con la estructura y datos de prueba se encuentra en la raíz del proyecto con el nombre: Dump20251118.

     



     🔹 Abra su gestor de base de datos favorito (phpMyAdmin, TablePlus, Workbench).

     



     🔹Cree una nueva base de datos vacía (por ejemplo: bienesraices_crud).

     



     🔹Importe el archivo Dump20251118 en dicha base de datos.





  6. Configuración de la Conexión



      🔹Para que el proyecto se conecte a su base de datos local:

      

      🔹Abra el archivo de configuración: /includes/config/database.php.

      

      🔹Verifique o actualice las credenciales en la función conectarDB:

      

      $db = mysqli_connect( 'localhost','root',      // Su usuario MySQL  '',          // Su contraseña (dejar vacío si usa XAMPP por defecto)   'bienesraices_crud' // El nombre de la BD que creó en el paso anterior);





# 📦 Ejecución del Proyecto



Compilar Frontend



Para procesar los estilos SASS y scripts JS:

# Para desarrollo (observa cambios en tiempo real)

    npm run dev



Iniciar Servidor

Asegúrese de que los servicios de Apache y MySQL estén corriendo. Acceda desde su navegador a la parte pública:

🔗 Link: http://localhost/BienesRaices







# 🔑 Acceso al Panel de Administración



🔹Nota Importante: El sitio público no cuenta con un botón de "Iniciar Sesión" en la navegación, ya que la gestión es de uso exclusivo del administrador/dueño.



🔹Para ingresar al panel de control, debe acceder manualmente a la siguiente dirección:

🔗 URL de acceso: 



    http://localhost/BienesRaices/login.php



(Una vez autenticado, será redirigido automáticamente al panel de administración en /admin).



Credenciales de prueba:

 🔹 Email

 

       correo@correo.com

  🔹Password

     

      123456



<p align="center">Desarrollado por Tomás Miqueleiz</p>
