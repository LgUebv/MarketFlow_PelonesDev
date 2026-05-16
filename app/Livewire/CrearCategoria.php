<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CategoriaService;

class CrearCategoria extends Component
{

    public $nombre = '';
    public $descripcion = '';

    protected $rules = [
        'nombre' => 'required|min:3',
        'descripcion' => 'nullable|max:255',
    ];

    public function Guardar(CategoriaService $categoriaService)
    {
        $this->validate();

        $categoriaService->createCategoria([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

        return redirect()->route('categorias');
    }

    public function Cancelar()
    {
        return redirect()->route('categorias');
    }

    public function render()
    {
        return view('livewire.categorias.crear-categoria')->layout('layouts.app');
    }
}
