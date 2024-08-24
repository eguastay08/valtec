<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_detalles', function (Blueprint $table) {
            $table->bigIncrements('orden_detalle_id');
            $table->unsignedBigInteger('orden_id');
            $table->foreign('orden_id')
            ->references('orden_id')
            ->on('ordens')
            ->onDelete('RESTRICT');    
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
            ->references('producto_id')
            ->on('productos')
            ->onDelete('RESTRICT');   
            $table->integer('cantidad');
            $table->decimal('precio',12,2);
            $table->decimal('subtotal',12,2);  
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('codigo_producto')->nullable();
            

            // $table->id();
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
        Schema::dropIfExists('ordens__detalles');
    }
}
