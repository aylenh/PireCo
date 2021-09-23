<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('rsocial');
            $table->string('nfanstasia');
            $table->string('domicilif');
            $table->string('cuit');
            $table->string('categoria');
            $table->string('tipofactura');
            $table->string('facturarcon');
            $table->string('contacto');
            $table->string('domicilioretiro');
            $table->string('telefonos');
            $table->string('mail');
            $table->string('observaciones');

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
        Schema::dropIfExists('clients');
    }
}
