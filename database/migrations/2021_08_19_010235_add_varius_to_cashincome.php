<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariusToCashincome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cashincome', function (Blueprint $table) {
            $table->string('service16')->nullable();
            $table->string('price16')->nullable();

            $table->string('service17')->nullable();
            $table->string('price17')->nullable();

            $table->string('service18')->nullable();
            $table->string('price18')->nullable();

            $table->string('service19')->nullable();
            $table->string('price19')->nullable();

            $table->string('service20')->nullable();
            $table->string('price20')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cashincome', function (Blueprint $table) {
            $table->dropColumn('service16');
            $table->dropColumn('price16');
            $table->dropColumn('service17');
            $table->dropColumn('price17');
            $table->dropColumn('service18');
            $table->dropColumn('price18');
            $table->dropColumn('service19');
            $table->dropColumn('price19');
            $table->dropColumn('service20');
            $table->dropColumn('price20');
        });
    }
}
