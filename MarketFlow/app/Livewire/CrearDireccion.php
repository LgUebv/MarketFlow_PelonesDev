<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\DireccionService;
use Illuminate\Support\Facades\Auth;

class CrearDireccion extends Component
{
    public $ciudad = '';
    public $calle = '';
    public $codigo_postal = '';
    public $numero_interior = '';
    public $numero_exterior = '';
    public $estado = '';
    public $colonia = '';
    public $refencias = '';

    protected $rules = [
        'ciudad'          => 'required|string|max:255',
        'calle'           => 'required|string|max:255',
        'codigo_postal'   => 'required|string|max:10',
        'numero_interior' => 'nullable|string|max:50',
        'numero_exterior' => 'nullable|string|max:50',
        'estado'          => 'required|string|max:255',
        'colonia'         => 'required|string|max:255',
        'refencias'       => 'nullable|string|max:500',
    ];

    public function guardar(DireccionService $direccionService)
    {
        // 2. Ejecutar validación
        $datos = $this->validate();

        // 3. Pasar los datos validados al servicio
        $direccionService->createDireccion($datos);

        // 4. Feedback y Redirección
        session()->flash('message', 'Dirección guardada exitosamente.');
        return redirect()->back();
    }

    public function cancelar()
    {
        return redirect()->route('direcciones.index');
    }

    public function render()
    {
        return view('livewire.direcciones.crear-direccion')->layout('layouts.app');
    }
}
