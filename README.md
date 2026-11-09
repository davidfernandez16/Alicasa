# Alicasa

Alicasa es una aplicación web de gestión de inmuebles y reservas. Permite consultar y filtrar alojamientos, crear cuentas, publicar inmuebles, gestionar reservas, escribir reseñas y administrar los datos de la plataforma.

## Arquitectura

- **Laravel 11 / PHP 8.2**: aplicación web siguiendo el patrón MVC.
- **Apache**: servidor web del contenedor de la aplicación.
- **MySQL 8**: persistencia de usuarios, inmuebles, reservas, ciudades y reseñas.
- **Docker Compose**: ejecuta la aplicación y la base de datos sin instalar PHP, Composer ni MySQL en Windows.
- **Autenticación y roles**: Laravel protege las rutas privadas y el middleware `admin` restringe el panel administrativo.

```text
Navegador → Laravel / Apache → MySQL
                 Docker Compose
```

## Requisitos

- Docker Desktop con Docker Compose.
- PowerShell.

## Ejecución en Windows

Entra en la carpeta de Laravel:

```powershell
cd Alicasa
Copy-Item .env.example .env
```

Edita `.env` y establece contraseñas locales para:

```dotenv
DB_PASSWORD=
MYSQL_ROOT_PASSWORD=
```

Genera una clave de Laravel y copia el valor mostrado en `APP_KEY` dentro de `.env`:

```powershell
docker compose run --rm --no-deps app php artisan key:generate --show
```

Inicia la aplicación y crea los datos iniciales:

```powershell
docker compose up -d
docker compose exec app php artisan migrate:fresh --seed
```

Abre [http://localhost:8081](http://localhost:8081).

> `migrate:fresh --seed` elimina y recrea la base de datos local. Úsalo para preparar una instalación nueva o reiniciar los datos de demostración.

## Estructura

```text
.
├── Alicasa/            # Aplicación Laravel y configuración Docker
├── MockUps/            # Diseños de las pantallas
└── Diagrama UML.png    # Modelo UML del proyecto
```

Dentro de `Alicasa/` se encuentran `app/` (controladores y modelos), `resources/views/` (vistas Blade), `database/` (migraciones y seeders), `routes/` y `tests/`.

## Comandos útiles

```powershell
# Ver el estado de los servicios
docker compose ps

# Detener el entorno conservando la base de datos
docker compose down

# Detenerlo y borrar la base de datos local
docker compose down -v
```

El archivo `.env` contiene configuración local y no se versiona.
