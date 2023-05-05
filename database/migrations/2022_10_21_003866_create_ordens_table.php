<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->bigIncrements('orden_id');
            $table->unsignedBigInteger('medio_pago_id')->nullable()->constrained();
            $table->foreign('medio_pago_id')
            ->references('medio_pago_id')
            ->on('medio_pagos')
            ->onDelete('RESTRICT'); 
            // $table->unsignedBigInteger('medio_pago_online_id')->nullable()->constrained();
            // $table->foreign('medio_pago_online_id')
            // ->references('medio_pago_online_id')
            // ->on('medios_pago_online')
            // ->onDelete('RESTRICT'); 
            $table->string('nombres',200);
            $table->mediumText('informacion_adicional');
            $table->string('email');
            $table->dateTime('fecha_pago',0);
            $table->char('n_operacion',30);
            $table->unsignedBigInteger('descuento_id')->nullable()->constrained();
            $table->foreign('descuento_id') 
            ->references('descuento_id')
            ->on('descuentos')
            ->onDelete('RESTRICT'); 
            $table->text('comprobante');
            $table->decimal('subtotal',12,2);
            $table->decimal('descuento',12,2)->nullable();
            $table->decimal('total',12,2);
            $table->string('ip',45);
            $table->dateTime('fecha_registro',0);
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
        Schema::dropIfExists('ordens');
    }
}
