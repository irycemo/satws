<?php

namespace App\Http\Livewire;

use App\Models\PagoSat;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Traits\ComponentesTrait;
use App\Models\PagoSatIrycem as Pagos;

class PagoSatIrycem extends Component
{
    use ComponentesTrait;
    use WithPagination;
    use WithFileUploads;

    public $search;
    public $flag;
    public $create = false;
    public $archivos = [];
    public $pagos_listos = [];

    public function resetearTodo(){

        $this->reset(['modalBorrar', 'crear', 'editar', 'modal', 'search', 'flag', 'create']);
        $this->resetErrorBag();
        $this->resetValidation();

        $this->dispatchBrowserEvent('removeFiles');
    }

    public function updatedArchivos(){

        if(!empty($this->archivos))
            $this->flag = true;
        else
            $this->flag = false;

    }

    public function procesar(){

        foreach($this->archivos as $archivo){

            $pago = [];

            try {

                $file = fopen($archivo->getRealPath(), 'r');

            } catch (\Throwable $th) {

                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "No se pudo abrir el archivo: " . $archivo->getClientOriginalName()]);

            }

            while (($line = fgets($file)) !== false) {

                if(Str::contains($line, 'concepto')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'solicitante')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'descripcion')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'importe')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'codigo_barras')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'ndias')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'adicional')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'programa')){

                    $string = explode('|', $line);

                    $pago[trim($string[0])] = trim($string[1]);

                }

                if(Str::contains($line, 'costos')){

                    $string = explode('|', $line);

                    $pago['pagado'] = trim($string[1]);

                }

                if(Str::contains($line, 'concepto_sap')){

                    $string = explode('|', $line);

                    $pago['principal'] = substr(trim($string[1]), 0, 4);
                    $pago['parcial'] = substr(trim($string[1]), 4);

                }

                if(Str::contains($line, 'limite')){

                    $string = explode('|', $line);

                    $pago['fecha_vencimiento'] = substr(trim($string[1]), 0, 4) . '-' . substr(trim($string[1]), 4, -2) . '-' . substr(trim($string[1]), 6);

                }

            }

            array_push($this->pagos_listos, $pago);

        }

        $this->flag = false;
        $this->create = true;
    }

    public function insertar(){

        foreach ($this->pagos_listos as $pago) {

            try {

                Pagos::create([
                    'concepto' => $pago['concepto'],
                    'solicitante' => $pago['solicitante'],
                    'descripcion' => $pago['descripcion'],
                    'importe' => $pago['importe'],
                    'codbarras' => $pago['codigo_barras'],
                    'ndias' => $pago['ndias'],
                    'adicional' => $pago['adicional'],
                    'programa' => $pago['programa'],
                    'principal' => $pago['principal'],
                    'parcial' => $pago['parcial'],
                    'pagado' => $pago['pagado'],
                    'fecha_vencimiento' => $pago['fecha_vencimiento'],
                ]);

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Hubo un error al insertar datos localmente"]);
                $this->resetearTodo();
            }

            $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Los datos se insertaron correctamente en base de datos local."]);

           /*  try {

                PagoSat::create([
                    'concepto' => $pago['concepto'],
                    'solicitante' => $pago['solicitante'],
                    'descripcion' => $pago['descripcion'],
                    'importe' => $pago['importe'],
                    'codbarras' => $pago['codigo_barras'],
                    'ndias' => $pago['ndias'],
                    'adicional' => $pago['adicional'],
                    'programa' => $pago['programa'],
                    'principal' => $pago['principal'],
                    'parcial' => $pago['parcial'],
                    'pagado' => $pago['pagado'],
                    'fecha_vencimiento' => $pago['fecha_vencimiento'],
                ]);

                $this->dispatchBrowserEvent('mostrarMensaje', ['success', "Los datos se insertaron correctamente en base de datos local."]);

            } catch (\Throwable $th) {
                $this->dispatchBrowserEvent('mostrarMensaje', ['error', "Hubo un error al insertar datos localmente"]);
            } */


        }

        $this->resetearTodo();

    }

    public function render()
    {

        $pagos = Pagos::where('norden', 'LIKE', '%' . $this->search . '%')
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
                            ->orWhere('parcial','like', '%'.$this->search.'%')
                            ->orWhere('usuario','like', '%'.$this->search.'%')
                            ->orderBy($this->sort, $this->direction)
                            ->paginate($this->pagination);

        return view('livewire.pago-sat-irycem', compact('pagos'))->extends('layouts.admin');
    }
}
