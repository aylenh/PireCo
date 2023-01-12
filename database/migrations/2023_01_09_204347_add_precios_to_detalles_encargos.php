<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreciosToDetallesEncargos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalles_encargos', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->Integer('liters')->nullable();
            $table->float('price', 2)->nullable();
            $table->float('total',  2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalles_encargos', function (Blueprint $table) {
            //
        });
    }
}
