<?php

class Product extends Eloquent
{
    /**
     * Attributes:
     *
     * int $id             - product id
     * int $seller_id      - the foreign key constraint on sellers
     * string $name        - name of the product
     * float $price        - price of the product
     * string $description - description for the product
     * int $inventory      - the number of items on-hand for the product
     */

    protected $table = 'products';

    /**
     * seller(): describes many-to-one relationship between Product
     * and Seller model
     */
    public function seller()
    {
        return $this->belongsTo('Seller');
    }

    /**
     * listings(): describes one-to-many relationship between Product
     * and Listing model
     */
    public function listings()
    {
        return $this->hasMany('Listing');
    }
}
