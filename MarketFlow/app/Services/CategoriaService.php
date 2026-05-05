<?php

namespace App\Services;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class CategoriaService
{
    // Funcion para mostrar todos las categorias, con su filtro
    public function getCategorias(?string $filtro = null) : Collection
    {
        $consulta = Categoria::where('activo', true);

        if($filtro)
        {
            $consulta -> where('nombre', 'LIKE', '%' . $filtro . '%');
        }

        return $consulta->orderBy('created_at', 'desc') -> get();
    }

    // Funcion para crear una nueva categoria
    public function createCategoria(array $datos): Categoria
    {
        return DB::transaction(function () use ($datos)
        {
            return Categoria::create([
                'nombre' => $datos['nombre'] ?? null,
                'descripcion' => $datos['descripcion'] ?? null,
                'activo' => $datos['activo'] ?? true,

            ]);
        });
    }

    // Funcion para modificar la categoria
    public function updateCategoria(Categoria $categoria, array $datos) : Categoria
    {
        $categoria -> update([
            'nombre' => $datos['nombre'] ?? $categoria -> nombre,
            'descripcion' => $datos['descripcion'] ?? $categoria -> descripcion,
            'activo' => $datos['activo'] ?? $categoria -> activo
        ]);

        return $categoria;
    }

    // Funcion para solamente desactivarla
    public function deleteCategoria(Categoria $categoria) : Categoria
    {
        $categoria -> update([
            'activo' => false
        ]);

        return $categoria;
    }
    // Funcion para eliminar definivamente la categoria
    // public function deleteCategoria(Categoria $categoria): void
    // {
    //     $categoria -> delete();
    // }
}
