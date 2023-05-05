<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('user_id');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('usuario');
            $table->string('email')->unique();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->text('foto')->nullable();
            $table->text('foto_name')->nullable();
            $table->text('foto_size')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('estado',1)->default(1);
            $table->char('oculto',1)->default(0);
            $table->string('usuario_registro',12);
            $table->dateTime('fecha_registro',0);
            $table->string('usuario_modifica',12)->nullable();
            $table->dateTime('fecha_modifica',0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
