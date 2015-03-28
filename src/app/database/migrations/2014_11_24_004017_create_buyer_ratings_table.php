<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyerRatingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buyer_ratings', function(Blueprint $table)
        {
            $table->increments('id');

            // foreign key on id of buyers table
            $table->integer('buyer_id')->unsigned();
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');

            // attributes contain a rating and rater_id
            $table->integer('rating')->unsigned();
            $table->integer('rater_id')->unsigned();

            // set keys
            $table->unique(array('rating', 'rater_id'));

            // created_at | updated_at
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
        Schema::dropIfExists('buyer_ratings');
    }
}
