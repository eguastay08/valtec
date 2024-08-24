<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoCodigosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_codigos', function (Blueprint $table) {
            $table->bigIncrements('producto_codigos_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
            ->references('producto_id')
            ->on('productos')
            ->onDelete('cascade');   
            $table->string('codigo',100);  
            $table->text('descripcion')->nullable();
            $table->char('estado',1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
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
        Schema::dropIfExists('producto_codigos');
    }
}
