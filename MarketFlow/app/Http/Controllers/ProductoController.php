<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\ImagenProducto;
use App\Http\Requests\ProductoRequest;
use App\Services\ProductoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Jalamos las categorías para el select del formulario
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request, ProductoService $service)
    {
        // Pasamos el array validado y el array de archivos por separado
        $service->guardarProducto(
            $request->validated(),
            $request->file('imagenes')
        );

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto, ProductoService $productoService)
    {
        // Llamada correcta al Service
        $this->productoService->actualizarProducto(
            $producto,
            $request->validated(),
            $request->file('imagenes')
        );

        return redirect()->route('productos.index')->with('success', '¡Actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, ProductoService $productoService)
    {
        $producto = Producto::findOrFail($id);
        $productoService->eliminarProducto($producto);

        return redirect()->route('productos.index');
    }

    public function destroyImage(ProductoImagen $imagen)
    {
        $this->productoService->deleteImage($imagen);
        return back()->with('success', 'Imagen eliminada');
    }
}
