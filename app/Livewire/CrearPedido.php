<?php

namespace App\Livewire;

use App\Services\DireccionService;
use App\Http\Requests\PedidoRequest;
use App\Services\PedidoService;
use App\Services\CarritoService;
use App\Models\Carrito;
use App\Models\Pedido;
use Livewire\Component;

class CrearPedido extends Component
{
    public $id_direccion;
    public $metodoPago;
    public $itemsCarrito = [];
    public $totalCompra = 0;


    public function render()
    {
        return view('livewire.pedidos.crear-pedido', [
                    'direcciones' => app(DireccionService::class)->getMiDireccion()
                    ])->layout('layouts.app');
    }

    // Funcion para cargar las direcciones y el carrito al iniciar el componente
    public function mount(CarritoService $carritoService, DireccionService $direccionService)
    {
        // Esto llena el combo al cargar la página
        $this->direcciones = $direccionService->getMiDireccion();

        // Obtenemos los productos del carrito
        $this->itemsCarrito = $carritoService->getCarrito();

        // Calculamos el total
        $this->totalCompra = $this->itemsCarrito->sum(function($item) {
            return $item->producto->precio * $item->cantidad;
        });

        if ($this->itemsCarrito->isEmpty()) {
            return redirect()->route('catalogo');
        }
    }

    // Función para confirmar la compra, recibe el servicio de pedido por inyección de dependencias
    public function confirmarCompra(PedidoService $pedidoService)
    {
        // Validamos los datos con el FormRequest
        $this->validate((new PedidoRequest())->rules());

        // Obtenemos los productos del carrito con su relación de producto para tener acceso al precio
        $items = Carrito::where('id_user', auth()->id())->with('producto')->get();

        // Si el carrito está vacío, hasta aqui llega el reporte joaquin
        if ($items->isEmpty()) {
            session()->flash('error', 'Tu carrito está vacío.');
            return;
        }

        // Ejecutamos la lógica a través del Service
        $pedido = $pedidoService->crearPedidoCompleto([
            'id_direccion' => $this->id_direccion,
            'metodoPago'   => $this->metodoPago,
            'totalCompra'  => $this->totalCompra,
        ], $items);

        // Redirigimos al usuario a Mis Compras con un mensaje de éxito
        if ($pedido) {
            session()->flash('message', '¡Pedido MF-' . $pedido->folio . ' creado con éxito!');
            return redirect()->route('mis-compras');
        }
    }
}
