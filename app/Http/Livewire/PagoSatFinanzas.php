<?php

namespace App\Http\Livewire;

use App\Models\PagoSat;
use Livewire\Component;
use App\Http\Traits\ComponentesTrait;
use Livewire\WithPagination;

class PagoSatFinanzas extends Component
{

    use ComponentesTrait;
    use WithPagination;

    public $search;

    public function render()
    {

        $pagos = PagoSat::where('norden', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('concepto', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('solicitante','like', '%'.$this->search.'%')
                            ->orWhere('descripcion','like', '%'.$this->search.'%')
                            ->orWhere('importe', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('codbarras','like', '%'.$this->search.'%')
                            ->orWhere('ndias','like', '%'.$this->search.'%')
                            ->orWhere('adicional', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('programa','like', '%'.$this->search.'%')
                            ->orWhere('recibo','like', '%'.$this->search.'%')
                            ->orWhere('fechapago', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('montopago','like', '%'.$this->search.'%')
                            ->orWhere('fechaentrega','like', '%'.$this->search.'%')
                            ->orWhere('fechacancelado', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('motivocancelado','like', '%'.$this->search.'%')
                            ->orWhere('solicitado','like', '%'.$this->search.'%')
                            ->orWhere('cancelado', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('pagado','like', '%'.$this->search.'%')
                            ->orWhere('archivo','like', '%'.$this->search.'%')
                            ->orWhere('fecha_registro', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('nocontrol','like', '%'.$this->search.'%')
                            ->orWhere('lineacaptura','like', '%'.$this->search.'%')
                            ->orWhere('fecha_vencimiento', 'LIKE', '%' . $this->search . '%')
                            ->orWhere('principal','like', '%'.$this->search.'%')
                            ->orWhere('usuario','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.pago-sat-finanzas', compact('pagos'))->extends('layouts.admin');
    }
}
