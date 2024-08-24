<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensMOrdenEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_m_orden_estados', function (Blueprint $table) {
            $table->bigIncrements('orden_m_orden_estado_id');
            $table->unsignedBigInteger('orden_id');
            $table->foreign('orden_id')
            ->references('orden_id')
            ->on('ordens')
            ->onDelete('RESTRICT');    
            $table->unsignedBigInteger('orden_estado_id');
            $table->foreign('orden_estado_id')
            ->references('orden_estado_id')
            ->on('ordens_estados')
            ->onDelete('RESTRICT');
            $table->char('estado',1);  
            $table->char('oculto',1);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
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
        Schema::dropIfExists('ordens_m__orden__estados');
    }
}
