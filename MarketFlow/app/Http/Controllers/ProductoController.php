<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\ImagenProducto;
use App\Http\Requests\ProductoRequest;
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
    public function store(ProductoRequest $request)
    {
        $producto = Producto::create([
            'id_categoria' => $request->id_categoria,
            'id_user' => auth()->id() ?? 1, // Por si no hay login aún
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'activo' => true
        ]);

        // 2. Revisar si vienen imágenes (usando el nombre 'imagenes' que pusimos en el form)
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $foto) {
                // Guardar el archivo físicamente
                $path = $foto->store('productos', 'public');

                // Crear el registro en la base de datos
                \App\Models\ImagenProducto::create([
                    'id_producto' => $producto->id_producto, // Usa la variable que creaste arriba
                    'rutaImagen'  => $path,
                    'portada'     => ($index === 0) ? true : false, // La primera foto será la portada
                ]);
            }
        }

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
    public function update(ProductoRequest $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        // Validamos igual que en el store
        $request->validate([
            'nombre' => 'required',
            'id_categoria' => 'required',
            'descripcion' => 'required',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        // Actualizamos los datos
        $producto->update([
            'id_categoria' => $request->id_categoria,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
        ]);

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index');
    }

    /**
     * Función para añadir imágenes a un producto
     */
    public function addImagenes(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                $path = $imagen->store('productos', 'public');

                $producto->imagenes()->create([
                    'rutaImagen' => $path,
                    'portada'  => false // Las nuevas no son portada por defecto
                ]);
            }
        }
        return back()->with('success', 'Fotos añadidas correctamente.');
    }

    /**
     * Función para eliminar una imagen de un producto
     */
    public function destroyImagen($id_imagen)
    {
        // Usamos el modelo que hizo tu compa
        $imagen = ImagenProducto::findOrFail($id_imagen);

        // 1. Borrar el archivo físico del storage
        if (\Storage::disk('public')->exists($imagen->rutaImagen)) {
            \Storage::disk('public')->delete($imagen->rutaImagen);
        }

        // 2. Borrar el registro de la base de datos
        $imagen->delete();

        return back()->with('info', 'Imagen eliminada.');
    }

    // Ejemplo para cambiar la portada
    public function setPortada(Producto $producto, ImagenProducto $imagen)
    {
        // 1. Ponemos todas las fotos de este producto en false
        $producto->imagenes()->update(['portada' => false]);

        // 2. Marcamos la seleccionada como true
        $imagen->update(['portada' => true]);

        return back()->with('flash', 'Portada actualizada');
    }
}
