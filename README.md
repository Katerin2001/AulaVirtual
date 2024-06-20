# Proyecto: Plataforma Virtual Moodle :rocket:

## Descripción :star:
Este proyecto es una plataforma virtual que simula el aula virtual de la Universidad Técnica de Ambato (UTA). El sistema permite a los usuarios realizar todas las funciones típicas de un aula virtual, como acceder a materiales de estudio, participar en foros de discusión y realizar evaluaciones. Además, el proyecto incluye una funcionalidad adicional que permite a los usuarios actualizar su foto de perfil utilizando la cámara en tiempo real.

## Tecnologías Utilizadas :hammer:
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) **PHP**: Para el desarrollo del backend y lógica de la aplicación.
- ![AJAX](https://img.shields.io/badge/AJAX-00ADD8?style=for-the-badge&logo=ajax&logoColor=white) **AJAX**: Para las comunicaciones asincrónicas entre el frontend y el backend.
- ![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) **HTML**: Para el desarrollo del frontend y la interacción con el usuario.
- ![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white) **CSS**: Para el desarrollo del frontend y la interacción con el usuario.
- ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) **JavaScript**: Para el desarrollo del frontend y la interacción con el usuario.
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white) **MySQL**: Para la gestión de la base de datos.

## Requisitos Previos :pencil:
- ![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white) Servidor web (por ejemplo, Apache)
- ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) PHP 7.0 o superior
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white) MySQL 5.6 o superior
- ![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white) Composer (para gestión de dependencias de PHP)
- ![Browser](https://img.shields.io/badge/Browser-4285F4?style=for-the-badge&logo=google-chrome&logoColor=white) Navegador web moderno
- ![Webcam](https://img.shields.io/badge/Webcam-000000?style=for-the-badge&logo=webcam&logoColor=white) Cámara web (para la funcionalidad de actualización de foto)

## Instrucciones para Clonar y Ejecutar el Proyecto

### Clonación del Repositorio
1. Abre una terminal o consola en tu computadora.
2. Navega al directorio donde deseas clonar el proyecto.
3. Ejecuta el siguiente comando para clonar el repositorio:
   ```bash
   git clone https://github.com/Katerin2001/AulaVirtual.git


### Instalación de la Base de Datos
1. Descarga e instala [XAMPP](https://www.apachefriends.org/index.html) en tu sistema si aún no lo has hecho.

2. Inicia el Panel de Control de XAMPP y asegúrate de que los servicios de Apache y MySQL estén activos.

3. Abre tu navegador web y visita `http://localhost/phpmyadmin`.

4. En phpMyAdmin, crea una nueva base de datos con el nombre `plataforma_virtual`.

5. Selecciona la base de datos recién creada (`plataforma_virtual`) en la barra lateral izquierda.

6. Haz clic en la pestaña "Importar" en la parte superior de la página.

7. Haz clic en el botón "Seleccionar archivo" y navega hasta el directorio donde clonaste el repositorio del proyecto.

8. Selecciona el archivo `plataforma_virtual.sql` y luego haz clic en "Continuar" para importar la base de datos.
