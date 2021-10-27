<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesEncargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_encargos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cantidad');
            $table->unsignedBigInteger('encargo_id');
            $table->unsignedBigInteger('producto_id');
            $table->timestamps();

            $table->foreign('encargo_id')->references('id')->on('encargos');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_encargos');
    }
}
