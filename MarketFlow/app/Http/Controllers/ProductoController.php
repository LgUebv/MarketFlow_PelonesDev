<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'descripcion' => 'required',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        Producto::create([
            'id_categoria' => $request->id_categoria,
            'id_user' => auth()->id() ?? 1, // Por si no hay login aún
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'stock' => $request->stock,
            'precio' => $request->precio,
            'activo' => true
        ]);

        return redirect()->route('productos.index');
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
        $categorias = \App\Models\Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
}
