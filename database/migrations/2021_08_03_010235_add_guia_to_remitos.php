<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGuiaToRemitos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientsbyserviceremitos', function (Blueprint $table) {
            $table->string('guia')->after('remito')->nullable();
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
            $table->dropColumn('guia');
        });
    }
}
