<?php

class Listing extends Eloquent
{
    /**
     * Attributes:
     *
     * int $id         - the listing id
     * int $product_id - the foreign key of the product_id
     * string $status  - an enum representing the listing status
     */

    protected $table = 'listings';

    /**
     * product(): describes the many-to-one relationship with the
     * Product model
     */
    public function product()
    {
        return $this->belongsTo('Product');
    }

    /**
     * seller(): describes the many-to-one relationship with the
     * Seller model
     */
    public function seller()
    {
        return $this->belongsTo('Seller');
    }
}
