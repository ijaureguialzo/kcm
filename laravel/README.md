# Laravel

Código fuente de la aplicación.

## Puesta en marcha

1. Conectarse al contenedor de php:

    ```shell
    cd docker
    ```

    ```shell
    make workspace
    ```

2. Instalar las dependencias de la aplicación:

    ```shell
    composer install
    ```

    ```shell
    npm install && npm run build
    ```

3. Crear el fichero `.env`:

    ```shell
    cp .env.example .env
    ```

4. Generar la clave de aplicación:

    ```shell
    php artisan key:generate
    ```

5. Salir del contenedor de php:

    ```shell
    exit
    ```

6. Renombrar todas las ocurrencias de `plantilla-laravel` en el fichero `.env`.

7. Crear las tablas de base de datos::

    ```shell
    make seed
    ```

8. Acceder a la aplicación en [este enlace](https://kcm.test).

## Paquetes utilizados

- [Laravel Localization](https://github.com/mcamara/laravel-localization)
- [Translatable String Exporter for Laravel](https://github.com/kkomelin/laravel-translatable-string-exporter)
- [Cloner](https://github.com/BKWLD/cloner)
- [Laravel Lang](https://laravel-lang.com/installation.html)
- [Laravel-permission](https://spatie.be/docs/laravel-permission/v6/introduction)

## Referencias

- [Trumbowyg](https://alex-d.github.io/Trumbowyg/)
- [How to use jQuery with Laravel and Vite](https://devdojo.com/thinkverse/how-to-use-jquery-with-laravel-and-vite)
- [vite-plugin-static-copy](https://github.com/sapphi-red/vite-plugin-static-copy)
