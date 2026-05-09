<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\DireccionService;

class ModificarDireccion extends Component
{

    public $id_direccion;
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

    public function mount(int $id, DireccionService $direccionService)
    {
        $direccion = $direccionService->getForId($id);

        $this->id_direccion    = $direccion->id_direccion;
        $this->id_user         = $direccion->id_user;
        $this->ciudad          = $direccion->ciudad;
        $this->calle           = $direccion->calle;
        $this->codigo_postal   = $direccion->codigo_postal;
        $this->numero_interior = $direccion->numero_interior;
        $this->numero_exterior = $direccion->numero_exterior;
        $this->estado          = $direccion->estado;
        $this->colonia         = $direccion->colonia;
        $this->refencias       = $direccion->refencias;
    }

    public function actualizar(DireccionService $direccionService)
    {
        $datos = $this->validate();

        $direccionService->updateDireccion($this->id_direccion, $datos);

        session()->flash('message', 'Dirección actualizada con éxito.');
        return redirect()->route('direcciones.index');
    }

    public function cancelar()
    {
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.direcciones.modificar-direccion')->layout('layouts.app');
    }
}
