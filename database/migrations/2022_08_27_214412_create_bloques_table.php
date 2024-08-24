<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloques', function (Blueprint $table) {
            $table->bigIncrements('bloque_id');
            $table->unsignedBigInteger('bloque_tipo_id');
            $table->foreign('bloque_tipo_id')
            ->references('bloque_tipo_id')
            ->on('bloque_tipos')
            ->onDelete('RESTRICT');  
            $table->longText('config');
            $table->string('titulo',255)->nullable();
            $table->text('icono')->nullable();
            $table->string('nombre_icono',100)->nullable();  
            $table->string('size_icono',50)->nullable();
            $table->integer('posicion');
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
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
        Schema::dropIfExists('bloques');
    }
}
