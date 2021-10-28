<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistribuidoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribuidores', function (Blueprint $table) {
            $table->id();
            $table->string('distribuidor_local');
            $table->string('distribuidor_correo');
            $table->string('distribuidor_contacto');
            $table->string('distribuidor_ubicacion');
            $table->string('distribuidor_latitude');
            $table->string('distribuidor_longitude');
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
        Schema::dropIfExists('distribuidores');
    }
}