<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

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
