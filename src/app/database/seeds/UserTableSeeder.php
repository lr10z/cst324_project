<?php

/**
 * UserTableSeeder
 *
 * User table seeder will create some test data for the users and
 * associated tables
 */

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // clear out all the user tables
        DB::table('users')->delete();
        DB::table('sellers')->delete();
        DB::table('buyers')->delete();

        // create a 'Buyer' user        
        $buyer = Buyer::create(
            ["items_bought"=>1]
        );

        $user = new User();
        $user->fill(
            [
                "first_name"=>"Bubbles",
                "last_name"=>"Cousins",
                "email"=>"bubbs@weebay.com",
                "password"=>Hash::make("sp2014")
            ]
        );

        $buyer->user()->save($user);
        
        // create a 'Seller' user
        $seller = Seller::create(
            [
                "store_name"=>"Barksdale's Famous",
                "items_sold"=>15
            ]
        );

        $user = new User();
        $user->fill(
            [
                "first_name"=>"Stringer",
                "last_name"=>"Bell",
                "email"=>"stringer@weebay.com",
                "password"=>Hash::make("sp2014")
            ]
        );

        $seller->user()->save($user);
    }
}
