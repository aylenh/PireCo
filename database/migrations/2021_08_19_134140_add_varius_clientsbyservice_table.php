<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Driver\PDOMySql\Driver;

class AddVariusClientsbyserviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientsbyservice', function($table)
        {
            $table->string('service16')->nullable()->after('price15');
            $table->string('price16')->nullable();

            $table->string('service17')->nullable();
            $table->string('price17')->nullable();

            $table->string('service18')->nullable();
            $table->string('price18')->nullable();

            $table->string('service19')->nullable();
            $table->string('price19')->nullable();

            $table->string('service20')->nullable();
            $table->string('price20')->nullable();

            /*  */

            $table->string('service21')->nullable();
            $table->string('price21')->nullable();

            $table->string('service22')->nullable();
            $table->string('price22')->nullable();

            $table->string('service23')->nullable();
            $table->string('price23')->nullable();

            $table->string('service24')->nullable();
            $table->string('price24')->nullable();

            $table->string('service25')->nullable();
            $table->string('price25')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientsbyserviceremitos', function($table)
        {
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
            /*  */
            $table->dropColumn('service21');
            $table->dropColumn('price21');
            $table->dropColumn('service22');
            $table->dropColumn('price22');
            $table->dropColumn('service23');
            $table->dropColumn('price23');
            $table->dropColumn('service24');
            $table->dropColumn('price24');
            $table->dropColumn('service25');
            $table->dropColumn('price25');
        });
    }
}
