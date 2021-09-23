<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashoutcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashoutcome', function (Blueprint $table) {
            $table->id();

            $table->string('service1')->nullable();
            $table->string('price1')->nullable();
            $table->string('service2')->nullable();
            $table->string('price2')->nullable();
            $table->string('service3')->nullable();
            $table->string('price3')->nullable();
            $table->string('service4')->nullable();
            $table->string('price4')->nullable();
            $table->string('service5')->nullable();
            $table->string('price5')->nullable();

            $table->string('service6')->nullable();
            $table->string('price6')->nullable();
            $table->string('service7')->nullable();
            $table->string('price7')->nullable();
            $table->string('service8')->nullable();
            $table->string('price8')->nullable();
            $table->string('service9')->nullable();
            $table->string('price9')->nullable();
            $table->string('service10')->nullable();
            $table->string('price10')->nullable();
            $table->string('service11')->nullable();
            $table->string('price11')->nullable();
            $table->string('service12')->nullable();
            $table->string('price12')->nullable();
            $table->string('service13')->nullable();
            $table->string('price13')->nullable();
            $table->string('service14')->nullable();
            $table->string('price14')->nullable();
            $table->string('service15')->nullable();
            $table->string('price15')->nullable();

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
        Schema::dropIfExists('cashoutcome');
    }
}
