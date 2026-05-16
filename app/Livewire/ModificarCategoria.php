<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CategoriaService;

class ModificarCategoria extends Component
{

    public $id;
    public $nombre = '';
    public $descripcion = '';



    public function mount($id, CategoriaService $categoriaService)
    {
        $categoria = $categoriaService->getForId($id);

        $this->id = $categoria->id_categoria;

        $this->nombre       = $categoria->nombre;
        $this->descripcion  = $categoria->descripcion;
    }

    public function editar(CategoriaService $categoriaService)
    {
        $this->validate([
            'nombre' => 'required|min:3',
            'descripcion' => 'nullable'
        ]);

        $categoriaService->updateCategoria($this->id, [
            'nombre'      => $this->nombre,
            'descripcion' => $this->descripcion
        ]);

    session()->flash('success', 'Categoría actualizada.');
    return redirect()->route('categorias');
}

    public function Cancelar()
    {
        return redirect()->route('categorias');
    }

    public function render()
    {
        return view('livewire.categorias.modificar-categoria')->layout('layouts.app');
    }
}
