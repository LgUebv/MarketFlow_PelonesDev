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
        // DESCOMENTAR ESTO EN CASO QUE NO HAYA LOGIN AÚN, NO ESTEN LOGEADOS O QUE NO TENGAN USUARIOS PARA ASIGNAR UN USUARIO POR DEFECTO
        // $producto = Producto::create([
        //     'id_categoria' => $request->id_categoria,
        //     'id_user' => auth()->id() ?? 1, // Por si no hay login aún
        //     'nombre' => $request->nombre,
        //     'descripcion' => $request->descripcion,
        //     'stock' => $request->stock,
        //     'precio' => $request->precio,
        //     'activo' => true
        // ]);
        $producto = Producto::create($request->validated());

        // Revisar si vienen imágenes (usando el nombre 'imagenes' que pusimos en el form)
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $foto) {
                // Guardar el archivo físicamente
                $path = $foto->store('productos', 'public');

                // Crear el registro en la base de datos
                ImagenProducto::create([
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
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $index => $foto) {
                $path = $foto->store('productos', 'public');

                // PUNTO 3: Checar si ya existe una portada
                $tienePortada = $producto->imagenes()->where('portada', true)->exists();

                $producto->imagenes()->create([
                    'rutaImagen' => $path,
                    // Si NO tiene portada, la primera foto de este loop se vuelve la portada
                    'portada' => (!$tienePortada && $index === 0) ? true : false
                ]);
            }
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado');
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
    public function addImagenes(Request $request, Producto $producto)
    {
        $request->validate([
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $path = $file->store('productos', 'public');

                // Creamos la relación
                $producto->imagenes()->create([
                    'rutaImagen' => $path,
                    'portada' => false
                ]);
            }
        }

        return back()->with('success', 'Imágenes añadidas con éxito');
    }

    /**
     * Función para eliminar una imagen de un producto
     */
    public function destroyImagen(ImagenProducto $imagen)
    {
        $id_producto = $imagen->id_producto; // Guardamos el ID del dueño de la foto
        $eraPortada = $imagen->portada;

        // 1. Borrar archivo físico
        if (\Storage::disk('public')->exists($imagen->rutaImagen)) {
            \Storage::disk('public')->delete($imagen->rutaImagen);
        }

        // 2. Borrar registro
        $imagen->delete();

        // 3. CAMBIO AUTOMÁTICO: Si borraste la portada, buscar otra foto para que tome el puesto
        if ($eraPortada) {
            $nuevaPortada = \App\Models\ImagenProducto::where('id_producto', $id_producto)->first();
            if ($nuevaPortada) {
                $nuevaPortada->update(['portada' => true]);
            }
        }

        return back()->with('info', 'Imagen eliminada');
    }
}
