<?php

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        // seed all tables
		$this->call('UserTableSeeder');
		$this->call('ProductTableSeeder');
		$this->call('ListingTableSeeder');
	}
}
