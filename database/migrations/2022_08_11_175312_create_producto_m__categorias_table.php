<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoMCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_m__categorias', function (Blueprint $table) {
            $table->bigIncrements('producto_m__categoria_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
            ->references('producto_id')
            ->on('productos')
            ->onDelete('RESTRICT');   
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')
            ->references('categoria_id')
            ->on('categorias')
            ->onDelete('RESTRICT'); 
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registra',12);
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
        Schema::dropIfExists('producto_m__categorias');
    }
}
