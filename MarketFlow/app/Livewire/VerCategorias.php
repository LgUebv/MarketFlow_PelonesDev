<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CategoriaService;

class VerCategorias extends Component
{
    public $search = "";

    protected CategoriaService $categoriaService;

    // Inicializar el servicio con boot()
    public function boot(CategoriaService $categoriaService): void
    {
        $this->categoriaService = $categoriaService;
    }

    public function eliminar(int $id_categoria): void
    {
        $this->categoriaService->deleteCategoria($id_categoria);
    }

    public function render()
    {
        $datos = $this->categoriaService->getCategorias($this->search ?: null);

        return view('livewire.categorias.ver-categorias', [
            'datos' => $datos,
        ])->layout('layouts.app');
    }
}
