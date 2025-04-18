<p align="center">
  <img src="public/logo.png" alt="Logo del proyecto" width="200">
</p>

## **Instrucciones**

Este proyecto está desarrollado sobre el framework **Laravel**, basado en **PHP 8.2**.  
Para ejecutarlo necesitas contar con un servidor local, como [Laragon](https://laragon.org/download/), y tener instalado [Composer](https://getcomposer.org/).

### Pasos para correr el proyecto:

1. Instalar dependencias con Composer:
   ```bash
   composer install

2. Crear el archivo .env (si aún no existe):
	```bash
	cp .env.example .env

3. Instalar dependencias con Composer:
	```bash
	php artisan key:generate

4. Configurar el archivo `.env` con los datos de conexión a la base de datos.  
    4.1. `DB_HOST`: tu host  
    4.2. `DB_PORT`: tu puerto (por defecto es 3306)  
    4.3. `DB_DATABASE`: tu base de datos  
    4.4. `DB_USERNAME`: tu usuario de la base de datos  
    4.5. `DB_PASSWORD`: tu contraseña de la base de datos

5. Ejecutar las migraciones (si aplica):
	```bash
	php artisan migrate

6. Ejecutar los seeder (este inserta los roles y usuarios nuevos):
	```bash
	php artisan db:seed

7. (Opcional) Generar la clave secreta para JWT:
	```bash
	php artisan jwt:secret

8. Levantar el servidor de desarrollo:
	```bash
	php artisan serve

9. Acceder desde el navegador:
	http://localhost:8000

10. Entrando al sistema ya puedes agregar con los usuarios proporcionados en la ruta "database/seeders/UserSeeder.php", están los usuarios creados y su password.

11. En la raiz del proyecto tienes un archivo llamado "boma-challenge.postman_collection.json" importarlo en postman y para funcionar los servicios cambiamos la url del proyecto al de "http://localhost:8000"

12. En la carpeta "auth" el servicio de "login" viene un usuario cargado y enviar y copiar el "token"

13. En la carpeta "metricas" están los dos servicios solicitados, debemos agrear el token en la pestaña "Authorization", en "Auth Type" se elige "Bearer Token" y en "Token" agregamos el token copiado y realizamos las solicitudes