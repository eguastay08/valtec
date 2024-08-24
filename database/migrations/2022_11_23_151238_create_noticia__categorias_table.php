<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiaCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_categorias', function (Blueprint $table) {
            // $table->id();
            // $table->timestamps();
            $table->bigIncrements('noticia_categoria_id');
            $table->string('noticia_categoria',40);
            $table->text('descripcion')->nullable();
            $table->integer('parent_id')->default(0);
            $table->text('url');
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
        Schema::dropIfExists('noticia_categorias');
    }
}
