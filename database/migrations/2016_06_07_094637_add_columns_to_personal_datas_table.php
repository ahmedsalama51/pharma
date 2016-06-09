<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToPersonalDatasTable extends Migration
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
            $table->integer('no_postups')->default(0)->after('no_posts');
            $table->integer('no_commentups')->default(0)->after('no_comments');
            $table->float('perentage')->default(0);

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
