<p align="center">
  <img src="public/logo.png" alt="Logo del proyecto" width="200">
</p>

## **Instrucciones**

Este proyecto está desarrollado sobre el framework **Laravel**, basado en **PHP**. Para ejecutarlo necesitas contar con un servidor local y [Composer](https://getcomposer.org/).

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

4. Configurar el archivo .env con los datos de conexión a la base de datos.
	4.1 DB_HOST: tu host
	4.2 DB_PORT: tu puerto(default es 3306)
	4.3 DB_DATABASE: tu base de datos
	4.4 DB_USERNAME: tu usuario de la base de datos
	4.5 DB_PASSWORD: tu contraseña de la base de datos

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