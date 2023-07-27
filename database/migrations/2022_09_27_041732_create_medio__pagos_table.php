<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedioPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medio_pagos', function (Blueprint $table) {
            $table->bigIncrements('medio_pago_id');
            $table->string('nombre',150);
            $table->mediumText('descripcion')->nullable();
            $table->char('deposito',1);
            $table->char('transferencia',1);
            $table->char('billetera_digital',1);
            $table->char('pago_online',1);
            $table->tinyText('data_value');
            $table->text('imagen')->nullabe();
            $table->string('nombre_img',200)->nullable();
            $table->string('size_img',200)->nullable();   
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
            // $table->id();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medio__pagos');
    }
}
