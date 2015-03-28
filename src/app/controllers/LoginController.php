<?php

class LoginController extends BaseController
{
    /**
     * loginUser(): Called when a user submits credentials to log in
     */
    public function loginUser()
    {
        // get the post data
        $email    = Input::get('email');
        $password = Input::get('password');

        // if already authenticated, just redirect to dashboard
        if (Auth::check())
        {
            return Redirect::to('/');
        }

        // otherwise, attempt to authenticate
        if (Auth::attempt(array('email' => strtolower($email), 'password' => $password)))
        {
            return Redirect::intended('/');
        }
        else
        {
            Session::flash('message', 'Your login credentials are incorrect.');
            return Redirect::back()->withInput();
        }
    }

    /**
     * logoutUser(): Called when a user logs out
     */
    public function logoutUser()
    {
        if (Auth::check())
        {
            Auth::logout();
            Session::flush();
            return Redirect::to('/');
        }
    }
}