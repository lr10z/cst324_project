<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function(Blueprint $table)
        {
            // drop columns
            $table->dropForeign('sellers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropColumn('seller_rating');

            // add new attributes
            $table->string('store_name')->after('id');
            $table->integer('items_sold')->unsigned()->after('store_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers', function(Blueprint $table)
        {
            // revert previous columns
            $table->integer('user_id')->unsigned()->after('id')->default(1);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('seller_rating')->unsigned()->after('user_id');

            // drop new columns
            $table->dropColumn('store_name');
            $table->dropColumn('items_sold');
        });
    }
}
