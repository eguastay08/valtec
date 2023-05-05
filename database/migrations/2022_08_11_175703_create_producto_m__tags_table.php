<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoMTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_m__tags', function (Blueprint $table) {
            $table->bigIncrements('producto_m__tag_id');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')
            ->references('producto_id')
            ->on('productos')
            ->onDelete('RESTRICT');   
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')
            ->references('tag_id')
            ->on('tags')
            ->onDelete('RESTRICT'); 
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registra',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
            // $table->id();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_m__tags');
    }
}
