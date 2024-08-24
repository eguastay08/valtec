<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estilos', function (Blueprint $table) {
            $table->bigIncrements('estilo_id');
            $table->unsignedBigInteger('estilo_tipo_id');
            $table->foreign('estilo_tipo_id')
            ->references('estilo_tipo_id')
            ->on('estilo_tipos')
            ->onDelete('RESTRICT');  
            $table->string('nombre',100);
            $table->string('variable',100)->nullable();
            $table->string('elemento',100);
            $table->string('propiedad',100);
            $table->string('valor',255)->nullable();
            $table->integer('posicion');
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
        Schema::dropIfExists('estilos');
    }
}
