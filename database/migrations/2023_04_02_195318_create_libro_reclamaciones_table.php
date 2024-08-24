<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroReclamacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->bigIncrements('libro_reclamacion_id');
            $table->char('tipo_doc',1)->default(1);
            $table->string('nro_documento',15);
            $table->string('nombre_apellidos',150);
            $table->string('direccion',100);
            $table->string('telefono',25);
            $table->string('correo',100);
            $table->char('id_bien_contratado',1)->default(1);
            $table->decimal('monto_reclamado',12,2);
            $table->char('tipo',1)->default(1);
            $table->text('detalle_cliente');
            $table->char('oculto',1)->default(0);
            $table->dateTime('fecha_registro',0);
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
        Schema::dropIfExists('libro_reclamaciones');
    }
}
