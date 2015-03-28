<?php

/**
 * ListingTableSeeder
 *
 * Listing table seeder will create some test data for the listings and
 * associated table
 */

class ListingTableSeeder extends Seeder
{
    public function run()
    {
        // clear out the listings table
        DB::table('listings')->delete();

        // get all rows from products table
        $products = Product::all();

        // create a listing for each product from products table
        foreach ($products as $product) 
        {
            $listing = new Listing();
            $listing->product_id = $product->id;
            $listing->seller_id = $product->seller_id;
            $listing->listing_title = $this->getRandomAdjective() . " " . $product->name .  " for sale!";
            $listing->status = 'in_progress';

            // save listing
            $product->listings()->save($listing);
        }
    }

    private function getRandomAdjective() 
    {
        $adjective = [
            'Superlative',
            'Amazing',
            'Awesome',
            'Exemplary',
            'Outstanding',
            'Extraordinary',
            'Unparallelled',
            'Super sexy',
            'Highly attractive',
            'Luxurious'
        ];

        return $adjective[rand(0, count($adjective) -1)];
    }
}
