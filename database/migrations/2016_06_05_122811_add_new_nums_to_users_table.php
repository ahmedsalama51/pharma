<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewNumsToUsersTable extends Migration
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
            $table->integer('no_comments')->default(0);
            $table->integer('no_interactions')->default(0);

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
