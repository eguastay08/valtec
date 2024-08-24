<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_tags', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('noticia_tag_id');
            $table->string('noticia_tag',40);
            $table->mediumText('url');
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registra',12);
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
        Schema::dropIfExists('noticia_tags');
    }
}
