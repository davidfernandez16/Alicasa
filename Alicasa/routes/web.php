<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ResenyaController;

// ──────────────────────────────────────────────────────────────────────────────
// 1. RUTAS PÚBLICAS
// ──────────────────────────────────────────────────────────────────────────────

// Página de inicio
Route::get('/', [InicioController::class, 'inicio'])->name('inicio');
// Alias a /inicio si lo necesitas
Route::get('/inicio', [InicioController::class, 'inicio']);
// Visualizar detalle de inmueble (público)
Route::get('/inicio/inmueble/{id}', [InicioController::class, 'ver_inmueble'])->name('inicio.inmueble');
// Búsqueda filtrada (público)
Route::get('/inicio/buscar', [InicioController::class, 'buscar'])->name('inicio.buscar');
Route::post('/inicio/listado', [InicioController::class, 'filtrar'])->name('inicio.filtrar');

// Página de contacto
Route::get('/inicio/contacto', [InicioController::class, 'contacto'])->name('inicio.contacto');

// Página de informacion
Route::get('/inicio/informacion', [InicioController::class, 'informacion'])->name('inicio.informacion');

// ──────────────────────────────────────────────────────────────────────────────
// 2. RUTAS DE AUTENTICACIÓN DE LARAVEL
// ──────────────────────────────────────────────────────────────────────────────
Route::get('/_test_auth', function () {
    return 'OK';
})->middleware('auth');
Auth::routes();


// ──────────────────────────────────────────────────────────────────────────────
// 3. RUTAS PROTEGIDAS (middleware auth)
// ──────────────────────────────────────────────────────────────────────────────

Route::middleware('auth')->group(function() {

    Route::post('/inmueble/{inmueble}/reservar', [ReservaController::class, 'reservar'])->name('reservar.inmueble');

    // Perfil de usuario
    Route::get('/perfil',   [PerfilController::class, 'perfil'])->name('perfil');

    // Panel y operaciones de administración
    Route::middleware('admin')->group(function() {
    Route::get('/admin',    [AdministradorController::class, 'admin'])->name('admin');
    

    // ELIMINAR registros
    Route::delete('/user/delete/{id}',      [UserController::class, 'borrar'])->name('user.eliminar');
    Route::delete('/inmueble/delete/{id}',  [InmuebleController::class, 'borrar'])->name('inmueble.eliminar');
    Route::delete('/reserva/delete/{id}',   [ReservaController::class, 'borrar'])->name('reserva.eliminar');
    Route::delete('/resenya/delete/{id}',   [ResenyaController::class, 'borrar'])->name('resenya.eliminar');
    Route::delete('/ciudad/delete/{id}',    [CiudadController::class, 'borrar'])->name('ciudad.eliminar');

    // MODIFICAR registros (form + acción)
    Route::get('/user/update/{id}',         [UserController::class, 'modificar_user'])->name('user.modificar_user');
    Route::put('/user/update/{id}',         [UserController::class, 'modificar'])->name('user.modificar');
    Route::get('/inmueble/update/{id}',     [InmuebleController::class, 'modificar_inmueble'])->name('inmueble.modificar_inmueble');
    Route::put('/inmueble/update/{id}',     [InmuebleController::class, 'modificar'])->name('inmueble.modificar');
    Route::get('/reserva/update/{id}',      [ReservaController::class, 'modificar_reserva'])->name('reserva.modificar_reserva');
    Route::put('/reserva/update/{id}',      [ReservaController::class, 'modificar'])->name('reserva.modificar');
    Route::get('/resenya/update/{id}',      [ResenyaController::class, 'modificar_resenya'])->name('resenya.modificar_resenya');
    Route::put('/resenya/update/{id}',      [ResenyaController::class, 'modificar'])->name('resenya.modificar');
    Route::get('/ciudad/update/{id}',       [CiudadController::class, 'modificar_ciudad'])->name('ciudad.modificar_ciudad');
    Route::put('/ciudad/update/{id}',       [CiudadController::class, 'modificar'])->name('ciudad.modificar');

    // INSERTAR registros (form + acción)
    Route::get('/user/insert',              [UserController::class, 'insertar_user'])->name('user.insertar_user');
    Route::post('/user/insert',             [UserController::class, 'insertar'])->name('user.insertar');
    Route::get('/inmueble/insert',          [InmuebleController::class, 'insertar_inmueble'])->name('inmueble.insertar_inmueble');
    Route::post('/inmueble/insert',         [InmuebleController::class, 'insertar'])->name('inmueble.insertar');
    Route::get('/reserva/insert',           [ReservaController::class, 'insertar_reserva'])->name('reserva.insertar_reserva');
    Route::post('/reserva/insert',          [ReservaController::class, 'insertar'])->name('reserva.insertar');
    Route::get('/resenya/insert',           [ResenyaController::class, 'insertar_resenya'])->name('resenya.insertar_resenya');
    Route::post('/resenya/insert',          [ResenyaController::class, 'insertar'])->name('resenya.insertar');
    Route::get('/ciudad/insert',            [CiudadController::class, 'insertar_ciudad'])->name('ciudad.insertar_ciudad');
    Route::post('/ciudad/insert',           [CiudadController::class, 'insertar'])->name('ciudad.insertar');

    // LISTAR / VER registros
    Route::get('/user/show',                [UserController::class, 'ver_usuarios'])->name('ver.user');
    Route::get('/inmueble/show',            [InmuebleController::class, 'ver_inmuebles'])->name('ver.inmueble');
    Route::get('/reserva/show',             [ReservaController::class, 'ver_reservas'])->name('ver.reserva');
    Route::get('/resenya/show',             [ResenyaController::class, 'ver_resenyas'])->name('ver.resenya');
    Route::get('/ciudad/show',              [CiudadController::class, 'ver_ciudades'])->name('ver.ciudad');

    // RELACIONES ENTRE TABLAS
    Route::get('/user/show/inmuebles/{id}',     [UserController::class, 'ver_inmuebles'])->name('user.ver_inmuebles');
    Route::get('/inmueble/show/user/{id}',      [InmuebleController::class, 'ver_usuario'])->name('inmueble.ver_user');
    Route::get('/inmueble/show/ciudad/{id}',    [InmuebleController::class, 'ver_ciudad'])->name('inmueble.ver_ciudad');
    Route::get('/reserva/show/user/{id}',       [ReservaController::class, 'ver_usuario'])->name('reserva.ver_user');
    Route::get('/reserva/show/inmueble/{id}',   [ReservaController::class, 'ver_inmueble'])->name('reserva.ver_inmueble');
    Route::get('/resenya/show/user/{id}',       [ResenyaController::class, 'ver_usuario'])->name('resenya.ver_user');
    Route::get('/resenya/show/inmueble/{id}',   [ResenyaController::class, 'ver_inmueble'])->name('resenya.ver_inmueble');
    Route::get('/ciudad/show/inmuebles/{id}',   [CiudadController::class, 'ver_inmuebles'])->name('ciudad.ver_inmuebles');

    // ORDENAR listados
    Route::get('/user/show/ordenar/{id}',       [UserController::class, 'ordenar'])->name('ordenar.user');
    Route::get('/inmueble/show/ordenar/{id}',   [InmuebleController::class, 'ordenar'])->name('ordenar.inmueble');
    Route::get('/reserva/show/ordenar/{id}',    [ReservaController::class, 'ordenar'])->name('ordenar.reserva');
    Route::get('/resenya/show/ordenar/{id}',    [ResenyaController::class, 'ordenar'])->name('ordenar.resenya');
    Route::get('/ciudad/show/ordenar/{id}',     [CiudadController::class, 'ordenar'])->name('ordenar.ciudad');

    });

    //BARRA MENU
    Route::get('/inicio/mis_reservas',                 [ReservaController::class, 'mis_reservas'])->name('mis_reservas');
    Route::get('/inicio/mis_resenyas',                 [ResenyaController::class, 'mis_resenyas'])->name('mis_resenyas');
    
    //RUTAS VISTA INMUEBLE
    Route::post('/inicio/inmueble/reservar/{id}',           [ReservaController::class, 'reservar'])->name('inicio.reservar');
    Route::post('/inicio/inmueble/reservar/cancelar/{id}',  [ReservaController::class, 'cancelar'])->name('inicio.reservar_cancelar');
    Route::post('/inicio/inmueble/comentar/{id}',           [ResenyaController::class, 'comentar'])->name('inicio.comentar');
    Route::post('/inicio/inmueble/comentar/editar/{id}',    [ResenyaController::class, 'editar'])->name('inicio.comentar_editar');
    Route::post('/inicio/inmueble/comentar/cancelar/{id}',  [ResenyaController::class, 'cancelar'])->name('inicio.comentar_cancelar');
    
    //RUTAS PERFIL
    Route::get('/perfil/subir_inmueble/{id}',               [PerfilController::class, 'subir_inmueble'])->name('perfil.subir_inmueble');
    Route::post('/perfil/subir_inmueble/{id}',     [PerfilController::class, 'insertar_inmueble'])->name('perfil.insertar_inmueble');
    Route::get('/perfil/editar/{id}',                       [PerfilController::class, 'editar_perfil'])->name('perfil.editar_perfil');

    //RUTAS PROPIETARIO
    Route::get('/perfil/mis_inmuebles/{id}',                [PerfilController::class, 'mis_inmuebles'])->name('propietario.mis_inmuebles');
    Route::get('/perfil/ver_reservas/{id}',                [PerfilController::class, 'ver_reservas'])->name('propietario.ver_reservas');
    Route::get('/perfil/ver_reservas/cancelar/{id}',                [PerfilController::class, 'cancelar'])->name('propietario.cancelar');
    Route::get('/perfil/ver_reservas/aceptar/{id}',                [PerfilController::class, 'aceptar'])->name('propietario.aceptar');    
});

// ──────────────────────────────────────────────────────────────────────────────
// 4. RUTA “HOME” (REDIRECCIÓN)
// ──────────────────────────────────────────────────────────────────────────────

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
