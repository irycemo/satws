<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoSatIrycem extends Model
{
    use HasFactory;

    protected $fillable = [
        'norden',
        'concepto',
        'solicitante',
        'descripcion',
        'importe',
        'codbarras',
        'ndias',
        'adicional',
        'programa',
        'recibo',
        'fechapago',
        'montopago',
        'fechaentrega',
        'fechacancelado',
        'motivocancelado',
        'solicitado',
        'cancelado',
        'pagado',
        'archivo',
        'fecha_registro',
        'nocontrol',
        'lineacaptura',
        'fecha_vencimiento',
        'principal',
        'parcial',
        'usuario'
    ];


}
