<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerEstilosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner__estilos', function (Blueprint $table) {
            $table->bigIncrements('banner__estilo_id');
            $table->string('nombre',100);
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
        Schema::dropIfExists('banner__estilos');
    }
}
