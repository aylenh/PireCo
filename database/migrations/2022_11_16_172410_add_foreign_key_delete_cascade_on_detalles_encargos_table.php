<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyDeleteCascadeOnDetallesEncargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detalles_encargos', function (Blueprint $table) {
            $table->dropForeign('detalles_encargos_encargo_id_foreign');
            $table->dropForeign('detalles_encargos_producto_id_foreign');

            $table->foreign('encargo_id')->references('id')->on('encargos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
