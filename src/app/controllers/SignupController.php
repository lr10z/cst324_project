<?php

class SignupController extends BaseController
{
    /**
     * signupUser(): given a new user's signup information, attempt to
     * create the new user and then authenticate into the app
     */
    public function signupUser()
    {
        // read the email and password from the request body
        $email    = Input::get('email');
        $password = Input::get('password');

        // check to see if email is already taken
        if ($this->isEmailTaken($email))
        {
            return Redirect::to('/login')
                ->with('message', "The email $email is already registered.")
                ->with('email', $email);
        }

        // check to see if email is in a valid format
        preg_match('/.+@.+/', $email, $matches);
        if (count($matches) < 1)
        {
            return $this->signupError("Please use a valid email address.");
        }

        // check to see if password is at least 6 characters
        if (strlen($password) < 6)
        {
            return $this->signupError("Passwords must be a minimum of 6 characters long.");
        }

        // attempt to create a new Buyer type user
        try
        {
            $buyer = new Buyer();
            $buyer->items_bought = 0;
            $buyer->save();

            $user = new User();
            $user->first_name = Input::get('firstname');
            $user->last_name  = Input::get('lastname');
            $user->email      = strtolower($email);
            $user->password   = Hash::make($password);
            
            $buyer->user()->save($user);

            // set the user to the currently logged in user
            if (Auth::attempt(array('email'=>$user->email, 'password'=>$password)))
            {
                return Redirect::to('/');
            }
            else
            {
                return $this->signupError("Could not login, please try again.");
            }
        }
        catch (Exception $e)
        {
            return $this->signupError($e->getMessage());
        }
    }

    /**
     * isEmailTaken(): check to see if the username already exists
     */
    private function isEmailTaken($email) 
    {
        $user = User::where('email', '=', $email)->first();
        return !is_null($user);
    }

    /**
     * registerRedirect(): return a redirect when there is an error
     * message
     */
    private function signupError($message) 
    {
        Session::flash('message', $message);
        return Redirect::back()->withInput();
    }
}
