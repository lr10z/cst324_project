<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBuyersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buyers', function(Blueprint $table)
        {
            // drop foreign key and user_id
            $table->dropForeign('buyers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('buyer_rating');

            // add new attributes
            $table->integer('items_bought')->unsigned()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buyers', function(Blueprint $table)
        {
            // revert previous columns
            $table->integer('user_id')->unsigned()->after('id')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('buyer_rating')->unsigned()->after('user_id');

            // drop new columns
            $table->dropColumn('items_bought');
        });
    }
}
