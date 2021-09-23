<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariusToRemitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientsbyserviceremitos', function (Blueprint $table) {
            $table->string('localidad')->after('guia')->nullable();
            $table->string('provincia')->after('localidad')->nullable();
            $table->string('adicionales')->after('provincia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientsbyserviceremitos', function (Blueprint $table) {
            $table->dropColumn('localidad');
            $table->dropColumn('provincia');
            $table->dropColumn('adicionales');
        });
    }
}
