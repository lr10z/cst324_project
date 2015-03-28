<?php

class HomeController extends BaseController
{
    public function showWelcome()
    {
        // Get a random item listing and set to the view data, so that
        // each time we load the welcome page a different featured
        // listing is highlighted
        $listing = Listing::orderByRaw('RAND()')->first();
        $this->viewData['listing'] = $listing;
        return View::make('main', $this->viewData);
    }

    public function showSignup()
    {
        return View::make('auth/signup');
    }

    public function showLogin()
    {
        return View::make('auth/login');
    }
}
