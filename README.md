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
	cp .env.example .env

3. Instalar dependencias con Composer:
	php artisan key:generate

4. Configurar el archivo .env con los datos de conexión a la base de datos.

5. Ejecutar las migraciones (si aplica):
	php artisan migrate

6. (Opcional) Generar la clave secreta para JWT:
	php artisan jwt:secret

7. Levantar el servidor de desarrollo:
	php artisan serve

8. Acceder desde el navegador:
	http://localhost:8000