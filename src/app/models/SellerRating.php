<?php

class SellerRating extends Eloquent
{
    protected $table = 'seller_ratings';

    /**
     * seller(): describes the many-to-one relationship with the
     * Seller model
     */
    public function user()
    {
        $this->belongsTo('Seller');
    }
}
