<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('banner_id');
            $table->unsignedBigInteger('bloque_id');
            $table->foreign('bloque_id')
            ->references('bloque_id')
            ->on('bloques')
            ->onDelete('RESTRICT');  
            $table->unsignedBigInteger('banner__estilo_id');
            $table->foreign('banner__estilo_id')
            ->references('banner__estilo_id')
            ->on('banner__estilos')
            ->onDelete('RESTRICT');  
            $table->string('titulo',255)->nullable();
            $table->string('link',150)->nullable();
            $table->integer('columnas');
            $table->integer('posicion');
            $table->text('banner')->nullable();
            $table->string('nombre_banner',255)->nullable();
            $table->string('size_banner',100)->nullable();   
            $table->text('banner_superpuesto')->nullable();
            $table->string('nombre_banner_superpuesto',255)->nullable();
            $table->string('size_banner_superpuesto',100)->nullable();  
            $table->char('estado',1)->default(1);
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
        Schema::dropIfExists('banners');
    }
}
