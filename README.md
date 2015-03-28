# CST 324 Database Project #

This project implements a mini "ebay" system, which is meant to
demonstrate basic RDBMS concepts, using the Laravel framework and
MySQL.

### Authors ###

* Dylan Gleason
* Leander Rodriguez

### Phase I Features ###

Phase I of the project implements the E/R design, database and table
schemas, the corresponding Model architecture as defined using the
Laravel framwork, as well as basic queries for accessing and
manipulating data.

Additionally, we setup a local MAMP (Macintosh-Apache-MySQL-PHP)
server in order to run the Laravel framework and access the MySQL
database.

##### E/R design #####

The database consists of the following E/R models:

* User
* Buyer
* Seller
* Product
* Listing
* BuyerRating
* SellerRating

The E/R design is expressed in terms of the following E/R diagram:

![Weebay ERD.png](https://bitbucket.org/repo/KzKkGg/images/2668144699-Weebay%20ERD.png)

##### Database Schema Creation #####

The database name was created with the following statement in MySQL:

```
#!MySQL

CREATE DATABASE cst324_database_project;
```

##### Configuring the MySQL connection #####

In order to allow Laravel to open connections to the Database, we must configure the configuration file in ``app/config/database.php``:

```
#!php
<?php

return array(

    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'cst324_database_project',
            'username'  => 'root',
            'password'  => 'sp2014',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        )
    )
);
```

##### Table/Relation Schema Creation #####

Tables are implemented using the Laravel framework's database
migration feature, which allows the programmer to design a table
Schema using Laravel's ORM (object relational mapping) syntax, as well
as revert their database to a previous state should things go
wrong. Here is an example of a simple users table, implemented as a
migration, which demonstrates a ``CREATE`` statement via the ``up``
method. When the migrations are run in reverse, the ``down`` function
will run, which represents a ``DROP`` statement.


```
#!php
<?php

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

To run the migrations in the order they were created, run the
following shell command:

```
#!bash

php artisan migrate
```

Conversely, to reset the table to an empty state, you can run the
following command:

```
#!bash

php artisan migrate:reset
```

If you create a new migration but want to rollback to the previous 
database state before the latest migration, you can run the
following command:

```
#!bash

php artisan migrate:rollback
```

##### Models #####

Models are implemented in PHP using the Laravel framework. Laravel
supports object-relational mapping using the Eloquent interface, which
allows seamless integration with database relations.

```
#!php
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
```

##### Queries to Modify the Data #####

Sample data for the tables were created using another Laravel facility
called database seeders. This provides a convenient way for creating
default sample data to populate the database. The below seeder class
will first ``DELETE`` any existing tuples from the users table, and
then ``INSERT`` new ones.


```
#!php
<?php

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
```

To run the seed, you can execute the following shell command using artisan:

```
#!bash

php artisan db:seed
```

### Phase II Features ###

The project was implemented using the Laravel framework, which uses
PHP as it's language. Laravel uses the MVC pattern, and provides a clean, REST-ful API
for creating routes, controllers, and views.

##### Routes #####

The following code example sets up a route to handle a ``POST``
request to the ``SearchController``'s ``search`` method.


```
#!php
<?php

// more routes ...

Route::post('/search', 'SearchController@search');
```


##### Controllers #####

The ``SearchController`` seen below, further illustrates how exactly
the ``POST`` request is handled. In this case, it will handle an Ajax
request, perform a search for the relevant listings, and then
construct a partial view and return it in JSON format to the client.


```
#!php

<?php

class SearchController extends BaseController
{
    /**
     * init the search categories array.
     *
     * @return void
     */
    public function __construct() 
    {
        parent::__construct();
    }

    /**
     * search(): given the search keyword and the category (if
     * available), search the database for the relevant listings
     *
     * @return json encoded string
     */
    public function search()
    {
        // read the POST fields
        $keyword  = trim(Input::get('search'));
        $category = trim(Input::get('category'));

        // pass this callback function to the query
        $callback = function ($query) use ($category)
        {
            if (!empty($category) && $category !== 'All Categories')
            {
                $category = $this->categories[$category];
                return $query->where('category', '=', $category);
            }
            return $query;
        };

        // Query listings that match the keyword
        $keyword  = "%$keyword%";
        $listings = Listing::whereHas('product', function($sub) use ($keyword, $callback)
        {
            $sub->where('name', 'LIKE', $keyword);
            $sub = $callback($sub);
        })
        ->orWhereHas('product', function($sub) use ($keyword, $callback)
        {
            $sub->where('description', 'LIKE', $keyword);
            $sub = $callback($sub);
        })
        ->get();

        // render the view with the new data
        $this->viewData['listings'] = $listings;
        $view = View::make('partials/search', $this->viewData)->render();
        return Response::json($view);
    }
}

```


##### Views #####

The corresponding view is rendered by the ``SearchController``. After
the controller sets the view data containing the listings, it will
render the following view, which uses the blade templating syntax to
dynamically set the variables before the HTML is rendered.

```
#!html

<h2>Results</h2>
@if (count($listings) < 1)
    <h5>No listings found. Please search again.</h5>
@else
    <h5>Click on a listing to view details.</h5>
@endif
<ul class="list-group">
    @foreach ($listings as $listing)
    <li class="list-item" data-id="{{{$listing->id}}}">
        <span class="item-name"><a href="/">{{{$listing->listing_title}}}</a></span>
        <span class="item-price">${{{$listing->product->price}}}</span>
    </li>
    @endforeach
</ul>
```

### Implementation Considerations ###

We chose to use the Laravel framework for the following reasons:

* The ability to use PHP, since we are both using a local MAMP configuration
* Relative ease of use
* Well designed MVC architecture
* High quality documentation

For this project, due to time contraints, we focused on implementation
of the following features:

* Basic listing search functionality
* Basic user authentication
* New user registration
* Simple graphical user interface for interaction.