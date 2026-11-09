# Alicasa

Alicasa es una aplicación web para buscar, publicar y gestionar inmuebles de alquiler. Los usuarios pueden registrarse, consultar alojamientos, realizar reservas y escribir reseñas. También existe un panel para administrar usuarios, inmuebles, reservas, reseñas y ciudades.

## Tecnologías

- Laravel 11 y PHP 8.2.
- MySQL 8 como base de datos.
- Blade, Bootstrap y recursos estáticos para la interfaz.
- Docker Compose para ejecutar la aplicación en Windows.

## Arquitectura

La aplicación sigue el patrón MVC de Laravel:

```text
Navegador → Laravel / Apache → MySQL
```

Las rutas privadas requieren iniciar sesión. Las operaciones del panel de administración requieren además el rol de administrador.

## Ejecutar el proyecto

Desde esta carpeta, crea la configuración local:

```powershell
Copy-Item .env.example .env
```

En `.env`, completa `DB_PASSWORD`, `MYSQL_ROOT_PASSWORD` y `APP_KEY`. Para obtener una clave de Laravel:

```powershell
docker compose run --rm --no-deps app php artisan key:generate --show
```

Inicia los contenedores y prepara la base de datos:

```powershell
docker compose up -d
docker compose exec app php artisan migrate:fresh --seed
```

La aplicación estará disponible en:

```text
http://localhost:8081
```

## Comandos útiles

```powershell
# Ver los contenedores activos
docker compose ps

# Detener el proyecto sin borrar los datos
docker compose down

# Reiniciar también la base de datos local
docker compose down -v
```

El archivo `.env` contiene datos locales y no se sube al repositorio.
