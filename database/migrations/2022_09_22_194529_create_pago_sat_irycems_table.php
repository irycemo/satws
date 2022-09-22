<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_sat_irycems', function (Blueprint $table) {
            $table->id('idpagosat');
            $table->string('norden')->nullable();
            $table->string('concepto')->nullable();
            $table->string('solicitante')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('importe')->nullable();
            $table->string('codbarras')->nullable();
            $table->string('ndias')->nullable();
            $table->string('adicional')->nullable();
            $table->string('programa')->nullable();
            $table->string('recibo')->nullable();
            $table->string('fechapago')->nullable();
            $table->string('montopago')->nullable();
            $table->string('fechaentrega')->nullable();
            $table->string('fechacancelado')->nullable();
            $table->string('motivocancelado')->nullable();
            $table->string('solicitado')->nullable();
            $table->string('cancelado')->nullable();
            $table->string('pagado')->nullable();
            $table->string('archivo')->nullable();
            $table->string('fecha_registro')->nullable();
            $table->string('nocontrol')->nullable();
            $table->string('lineacaptura')->nullable();
            $table->string('fecha_vencimiento')->nullable();
            $table->string('principal')->nullable();
            $table->string('parcial')->nullable();
            $table->string('usuario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_sat_irycems');
    }
};
