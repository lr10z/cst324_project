<?php

class BuyerRating extends Eloquent
{
    protected $table = 'buyer_ratings';

    /**
     * buyer(): desribes the many-to-one relationship with the Buyer
     * model
     */
    public function buyer()
    {
        return $this->belongsTo('Buyer');
    }
}
