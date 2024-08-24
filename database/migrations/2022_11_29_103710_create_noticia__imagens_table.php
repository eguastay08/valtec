<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_imagens', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('noticia_imagen_id');
            $table->unsignedBigInteger('noticia_id');
            $table->foreign('noticia_id')
            ->references('noticia_id')
            ->on('noticias')
            ->onDelete('RESTRICT');    
            $table->string('imagen',100);  
            $table->string('size',50);
            $table->text('url'); 
            $table->char('principal',1)->default(0);
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
        Schema::dropIfExists('noticia_imagens');
    }
}
