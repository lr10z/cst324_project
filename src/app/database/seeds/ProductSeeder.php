<?php

/**
 * ProductTableSeeder
 *
 * Product table seeder will create some test data for the products and
 * associated table
 */

class ProductTableSeeder extends Seeder
{
    public function run()
    {
        // clear out the products table
        DB::table('products')->delete();

        // get relevant seller
        $seller = Seller::whereHas('user', function($query) { $query->where('email', '=', 'stringer@weebay.com'); })->first();

        // create products
        $products = array(
            new Product(array('name' => 'macbook pro', 'category' => 'computer', 'description' => 'made by apple', 'price' => 1499.99, 'inventory' => 10)),
            new Product(array('name' => 'lenovo thinkpad', 'category' => 'computer', 'description' => 'made by lenovo', 'price' => 999.99, 'inventory' => 10)),
            new Product(array('name' => 'iphone 6', 'category' => 'cell phone', 'description' => 'made by apple', 'price' => 199.99, 'inventory' => 10)),
            new Product(array('name' => 'blackberry passport', 'category' => 'cell phone', 'description' => 'made by blackberry', 'price' => 499.99, 'inventory' => 10)),
            new Product(array('name' => 'samsung galaxy s5', 'category' => 'cell phone', 'description' => 'made by samsung', 'price' => 249.99, 'inventory' => 10)),
            new Product(array('name' => 'samsung galaxy note', 'category' => 'cell phone', 'description' => 'made by samsung', 'price' => 199.99, 'inventory' => 10)),
            new Product(array('name' => 'nikon coolpix', 'category' => 'camera', 'description' => 'made by nikon', 'price' => 199.99, 'inventory' => 10)),
            new Product(array('name' => 'canon rebel', 'category' => 'camera', 'description' => 'made by canon', 'price' => 499.99, 'inventory' => 10)),
            new Product(array('name' => 'samsung 4k', 'category' => 'tv', 'description' => 'made by samsung', 'price' => 2999.99, 'inventory' => 10)),
            new Product(array('name' => 'sony led', 'category' => 'tv', 'description' => 'made by sony', 'price' => 999.99, 'inventory' => 10))
        );

        // associate all newly created products with relevant seller
        $seller->products()->saveMany($products);
    }
}
