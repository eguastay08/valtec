<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaMNoticiaCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_m_noticia_categorias', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('noticia_m_noticia_categoria_id');
            $table->unsignedBigInteger('noticia_id');
            $table->foreign('noticia_id')
            ->references('noticia_id')
            ->on('noticias')
            ->onDelete('RESTRICT');    
            $table->unsignedBigInteger('noticia_categoria_id');
            $table->foreign('noticia_categoria_id')
            ->references('noticia_categoria_id')
            ->on('noticia_categorias')
            ->onDelete('RESTRICT');
            $table->char('oculto',1);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticia_m_noticia_categorias');
    }
}
