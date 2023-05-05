<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('producto_id');
            $table->string('producto');
            $table->text('descripcion_producto')->nullable();
            $table->decimal('precio_compra',12,2)->default(0);
            $table->decimal('precio_anterior',12,2)->nullable()->default(0);
            $table->decimal('precio',12,2);
            $table->decimal('precio_oferta',12,2)->nullable()->default(0);;
            $table->integer('monedas')->nullable();
            $table->char('con_stock',1)->default(0);
            $table->integer('stock')->nullable();
            $table->text('url');
            $table->mediumText('video')->nullable();
            $table->char('carrousel',1)->default(1);
            $table->char('estreno',1)->default(1);
            $table->char('oferta',1)->default(1);
            $table->char('promo_dia',1)->default(1);
            $table->char('agotado',1)->default(0);
            $table->char('descuento',5)->nullable();
            $table->dateTime('fecha_finalizacion',0)->nullable();
            $table->char('envio_domicilio',1)->default(1);
            $table->char('recojo',1)->default(1);
            $table->char('contraentrega',1)->default(1);
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registra',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();

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
        Schema::dropIfExists('productos');
    }
}
