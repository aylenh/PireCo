<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->bigInteger('travel_id')->unsigned()->unique(); //Un Viaje solo puede tener un pago
            //$table->foreign('travel_id')->references('id')->on('travels');
            $table->string("external_reference");
            $table->string("order_code")->nullable();
            $table->string("init_point")->nullable();
            $table->boolean("payed")->default(false);
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
        Schema::dropIfExists('payments');
    }
}
