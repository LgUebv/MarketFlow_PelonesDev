<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\DetalleProductoService;

class VerDetalleProducto extends Component
{
    public $producto;

    public function mount(int $id, DetalleProductoService $detalleService)
    {
        $this->producto = $detalleService->getProductoForId($id);
    }

    public function render()
    {
        return view('livewire.ver-detalle-producto') -> layout('layouts.app');
    }
}
