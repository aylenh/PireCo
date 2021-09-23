<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsbyserviceremitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientsbyserviceremitos', function (Blueprint $table) {
            $table->id();

            $table->string('idCLient');
            $table->string('fecha');
            $table->string('remito');
            $table->string('counter');
            $table->string('quantity');
            $table->string('price');

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
        Schema::dropIfExists('clientsbyserviceremitos');
    }
}
