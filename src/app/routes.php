<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// GET requests

Route::get('/', 'HomeController@showWelcome');

Route::get('/login', 'HomeController@showLogin');

Route::get('/signup', 'HomeController@showSignup');

Route::get('/auth/logout', 'LoginController@logoutUser');

Route::get('/listing/{id}', 'ListingController@getListing');

// POST requests

Route::post('/search', 'SearchController@search');

Route::post('/auth/signup', 'SignupController@signupUser');

Route::post('/auth/login', 'LoginController@loginUser');
