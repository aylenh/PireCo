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
            $table->string('correo');
            $table->string('horario_de');
            $table->string('horario_hasta');
            $table->string('bidon_20');
            $table->string('bidon_10');
            $table->string('botella_1');
            $table->string('total');
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
        Schema::dropIfExists('encargos');
    }
}
