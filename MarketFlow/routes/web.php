<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use Laravel\Jetstream\Jetstream;

Route::get('/', function () {
    return view('welcome');
});

// Esta ruta (Catálogo) la pongo aquí porque necesitamos que no necesite
// autenticarse por Jetstream
Route::get('/catalogo', function () {
    return 'Vista del catálogo en construcción';})->name('catalogo');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Ruta para productos
Route::resource('productos', ProductoController::class);

// Para borrar una imagen específica
Route::delete('/imagen-producto/{imagen}', [ProductoController::class, 'destroyImagen'])->name('productos.imagen.destroy');

// Para añadir nuevas imágenes desde el modal
Route::post('/producto/{producto}/add-imagenes', [ProductoController::class, 'addImagenes'])->name('productos.imagen.add');
