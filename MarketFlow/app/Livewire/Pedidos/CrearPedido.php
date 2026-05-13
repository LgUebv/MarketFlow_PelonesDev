<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;

class CrearPedido extends Component
{
    // Datos de prueba para maquetar
    public $productos = [
        ['nombre' => 'Objeto #1', 'cantidad' => 1, 'precio' => 1000],
        ['nombre' => 'Objeto #2', 'cantidad' => 2, 'precio' => 2400],
    ];

    public function render()
    {
        return view('livewire.pedidos.crear-pedido')->layout('layouts.app');
    }
}
