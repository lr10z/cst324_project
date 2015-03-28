<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSelleridColumnToListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('listings', function(Blueprint $table)
		{
			$table->integer('seller_id')->unsigned()->after('product_id');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->string('listing_title')->after('seller_id');
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
			$table->dropForeign('listings_seller_id_foreign');
            $table->dropColumn('seller_id');
            $table->dropColumn('listing_title');
		});
	}
}