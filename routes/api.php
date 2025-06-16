<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    DestinoController,
    EtapaTourController,
    OfertaController,
    OfertaTourController,
    ReservaController,
    ReservaTourController,
    TourController,
    UsuarioController
};

Route::get('/', function () {
    return view('welcome');
});
// Rutas públicas (acceso abierto, por ejemplo: login, registro, listado de tours públicos, etc.)
Route::post('/register', [UsuarioController::class, 'register']);
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('user-by-email/{email}', [UsuarioController::class, 'getByEmail']);
Route::get('ofertasUs/{id}', [OfertaController::class, 'getById']);
Route::get('/users', [UsuarioController::class, 'index']);
Route::get('/users/{id}', [UsuarioController::class, 'getById']);
Route::get('/tours', [TourController::class, 'index']);
Route::get('/etapas/{id}', [EtapaTourController::class, 'getById']);
Route::get('/destinos', [DestinoController::class, 'index']);
Route::post('/newdestino', [DestinoController::class, 'store']);
Route::get('destinos/{name}', [DestinoController::class, 'getByName']);
Route::get('destinosname/{id}', [DestinoController::class, 'getById']  );
Route::get('/ofertas', [OfertaController::class, 'index']);
Route::DELETE('/etapas-tours-rm/{id}', [EtapaTourController::class, 'deleteByTourId']);
Route::get('/reservasusu/{id}', [ReservaController::class, 'getReservasByUser']);

// Rutas protegidas (solo para usuarios autenticados)
//Route::middleware('firebase.auth')->group(function () {

    // Gestión del usuario autenticado
    Route::get('/me', [UsuarioController::class, 'me']);
    Route::post('/logout', [UsuarioController::class, 'logout']);

    // CRUD completo protegido
    Route::apiResource('usuarios', UsuarioController::class)->except(['store']);
    Route::apiResource('reservas', ReservaController::class);
    Route::apiResource('tours', TourController::class)->except(['index']);
    Route::apiResource('destinos', DestinoController::class)->except(['index']);
    Route::apiResource('etapas-tours', EtapaTourController::class);
    Route::apiResource('ofertas', OfertaController::class)->except(['index']);
    Route::apiResource('ofertas-tours', OfertaTourController::class);
    Route::apiResource('reservas-tours', ReservaTourController::class);
//});
