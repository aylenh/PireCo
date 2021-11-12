<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encargos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('domicilio');
            $table->string('telefono');
            $table->string('correo')->nullable();
            $table->string('horario_de');
            $table->string('horario_hasta');
            $table->string('total');
            $table->unsignedBigInteger('distribuidor_id')->nullable();
            $table->timestamps();

            $table->foreign('distribuidor_id')->references('id')->on('distribuidores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encargos');
    }
}
