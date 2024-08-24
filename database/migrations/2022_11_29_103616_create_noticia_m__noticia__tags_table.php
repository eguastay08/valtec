<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaMNoticiaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_m_noticia_tags', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('noticia_m_noticia_tag_id');
            $table->unsignedBigInteger('noticia_id');
            $table->foreign('noticia_id')
            ->references('noticia_id')
            ->on('noticias')
            ->onDelete('RESTRICT');    
            $table->unsignedBigInteger('noticia_tag_id');
            $table->foreign('noticia_tag_id')
            ->references('noticia_tag_id')
            ->on('noticia_tags')
            ->onDelete('RESTRICT');
            $table->char('oculto',1);
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
        Schema::dropIfExists('noticia_m__noticia__tags');
    }
}
