<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumsToPersonalDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('personal_datas', function(Blueprint $table)
        {
            $table->integer('no_followers')->default(0);
            $table->integer('no_posts')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_datas', function($table) {
        $table->dropColumn('confirmed');
        });
    }
}
