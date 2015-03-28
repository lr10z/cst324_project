<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     * ORM attributes:
     * $id            - the user id
     * $first_name    - the first name of the user
     * $last_name     - the last name of the user
     * $password      - user's password (hashed)
     * $userable_id   - the id linked to User subclass table
     * $userable_type - the userable type, e.g. Buyer or Seller
     */

    protected $table = 'users';

    protected $hidden = array('password', 'remember_token');

    /**
     * userable(): provides a mechanism for runtime polymorphism on
     * user subtypes
     */
    public function userable()
    {
        return $this->morphTo();
    }
}
