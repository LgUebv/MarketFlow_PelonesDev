<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Services\DireccionService;
use Livewire\Component;


class VerDirecciones extends Component
{
    public $search = "";

    protected DireccionService $direccionService;

    public function boot(DireccionService $direccionService) : void
    {
        $this->direccionService = $direccionService;
    }

    public function eliminar(int $id_direccion, DireccionService $direccionesService)
    {
        $direccionesService->deleteDireccion($id_direccion);
        session()->flash('message', 'Dirección eliminada correctamente.');
    }


    public function render()
    {
        $datos = $this->direccionService->getDirecciones($this->search ?: null);
            return view('livewire.direcciones.ver-direcciones', [
                'datos' => $datos
            ])->layout('layouts.app');
    }
}
