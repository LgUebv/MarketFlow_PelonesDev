<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\DireccionService;

class VerMisDirecciones extends Component
{
    public function eliminar(int $id_direccion, DireccionService $direccionesService)
    {
        $direccionesService->deleteDireccion($id_direccion);
        session()->flash('message', 'Dirección eliminada correctamente.');
    }

    public function render(DireccionService $direccionService)
    {
        return view('livewire.direcciones.ver-mis-direcciones', [
            'datos' => $direccionService->getMiDireccion()
        ])->layout('layouts.app');
    }
}
