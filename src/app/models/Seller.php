<?php

class Seller extends Eloquent
{
    /**
     * ORM attributes:
     * $id          - the seller id
     * $store_name  - the name of the seller's store
     * $items_sold  - the number of total items sold
     */

    protected $table = 'sellers';

    /**
     * user(): defines parent relationship to User class
     */
    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
    
    /**
     * sellerRatings(): as a seller, a user can have many different
     * ratings from other users
     */
    public function sellerRatings()
    {
        return $this->hasMany('SellerRating');
    }

    /**
     * products(): as a seller, a user can have many different
     * products to sell
     */
    public function products()
    {
        return $this->hasMany('Product');
    }

    /**
     * listings(): as a seller, a user can have many different
     * listings for their products
     */
    public function listings()
    {
        return $this->hasMany('Listing');
    }
}
