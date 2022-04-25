<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('distribuidor_id')->nullable();
            $table->string('nombre')->nullable();
            $table->string('cel_cliente')->nullable();
            $table->bigInteger('bidon10')->nullable();
            $table->bigInteger('bidon20')->nullable();
            $table->bigInteger('estado')->nullable();
            $table->string('correo_cliente')->nullable();
            $table->string('pago')->nullable();
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
        Schema::dropIfExists('inventarios');
    }
}
