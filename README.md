# prueba_tecnica_dev_NEXURA
Prueba técnica de desarrollo en PHP - Framework(Laravel)


# Instructivo para la ejecucion de la aplicacion

1- Crear una base de datos con el nombre de: prueba_tecnica_dev.

2- Edite el nombre del archivo .env.example y que solo quede .env, luego modifique el archivo .env con los datos de su servidor de DB.

3- Abra una terminal de comandos, luego se sitúa en la carpeta del proyecto o carpeta raiz de este.

4- Proceda a ingresar los comandos en este orden:

    php artisan key:generate
    
    php artisan migrate --seed
    
    php artisan serve
    
5. Ingrese al Servidor local y ponga :8000 por ejemplo = http://127.0.0.1:8000 o la URL que le indique la teminal de comandos.

6. Puede cambiar el puerto de la siguiente manera en la terminal de comandos.

    php artisan serve --port=8080
