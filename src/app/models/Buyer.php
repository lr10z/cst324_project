<?php

class Buyer extends Eloquent
{
    /**
     * ORM attributes:
     * $id           - the id of the Buyer
     * $items_bought - the number of items bought by the user
     */

    protected $table = 'buyers';

    /**
     * user(): defines parent relationship to User class
     */
    public function user()
    {
        return $this->morphOne('User', 'userable');
    }
    
    /**
     * buyerRatings(): as a buyer, a user can have many different
     * ratings from other users
     */
    public function buyerRatings()
    {
        return $this->hasMany('BuyerRating');
    }
}
