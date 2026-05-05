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

Route::delete('/imagen/{id_imagen}', [ProductoController::class, 'destroyImagen'])->name('productos.destroyImagen'); //eliminar imagen
Route::post('/producto/{producto}/portada/{imagen}', [ProductoController::class, 'setPortada'])->name('productos.setPortada'); //marcar como portada
Route::post('/producto/{id}/add-imagenes', [ProductoController::class, 'addImagenes'])->name('productos.addImagenes'); //agregar más imágenes a un producto existente
