<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\PedidoService;

class MisCompras extends Component
{
    public function render(PedidoService $pedidoService)
    {
        return view('livewire.mis-compras', [
            // Llamamos al service para traer la data
            'pedidos' => $pedidoService->obtenerHistorialUsuario()
        ])->layout('layouts.app');
    }
}
