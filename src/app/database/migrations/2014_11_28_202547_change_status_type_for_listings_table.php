<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusTypeForListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function(Blueprint $table)
        {
            $table->dropColumn('status');
        });

        Schema::table('listings', function(Blueprint $table)
        {
            $table->enum('status', array('in_progress', 'completed'))->after('product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function(Blueprint $table)
        {
            $table->dropColumn('status');
        });

        Schema::table('listings', function(Blueprint $table)
        {
            $table->string('status');
        });
    }
}
