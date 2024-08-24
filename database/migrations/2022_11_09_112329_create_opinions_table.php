<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opiniones', function (Blueprint $table) {
            $table->bigIncrements('opinion_id');
            $table->string('nombre',200);
            $table->string('apellido',200);
            $table->integer('calificacion');
            $table->string('facebook_id',250);
            $table->mediumText('comentario');
            $table->integer('auth')->default(0);
            $table->dateTime('fecha_registro',0);
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
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
        Schema::dropIfExists('opiniones');
    }
}
