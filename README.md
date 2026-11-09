# DSS2025

Para comenzar con el proyecto tenemos que hacer los siguientes pasos (teniendo la base de datos vacia):

``` 
git clone ...

composer install

cp .env.example .env
```
Configuramos .env con los datos de la base de datos si la tenemos creada, sino tocaria crear una base de datos muy facilmente con CREATE DATABASE "nombre base de datos":
```
php artisan key:generate

php artisan migrate:install

php artisan migrate

php artisan db:seed
```
Si lo que queremos es actualizar la base de datos con las migraciones o los seeders y ya la hemos creado no hay que usar los pasos de arriba porque nos dará error, tenemos que ejecutar este comando que reinicia lsa migraciones y los seeders:

```
php artisan migrate:refresh  --seed
```
Una vez completados estos pasos tendremos el proyecto de Laravel configurado para o bien seguir trabajando con ello o bien ejecutarlo con el siguiente comando dentro de la carpeta Alicasa y teniendo todas las dependencias instaladas:

```
php artisan serve
```

Si queremos trabajar con el proyecto y ya lo tenemos instalado y configurado, tenemos que seguir estos pasos:

```
git checkout develop
git pull origin "develop"
git checkout "mi rama"
git merge develop
git push origin "mi rama"
```
Estos pasos son para actualizar tu rama y añadir las ultimas actualizaciones de develop que no tengas en tu rama, si lo que quieres es subir tus modificaciones a tu rama y luego añadirlas a develop hayq ue seguir estos pasos:

```
git checkout "mi rama"
git add .
git commit -m "comentario"
git push origin "mi rama"
git checkout develop
git merge "mi rama"
git push origin develop
```
