<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Login page
     */
    public function login() {
        return view('login');
    }

    /**
     * Login
     *
     * @param  Request
     * @return Response
     */
    public function validateLogin(Request $request)
    {
        // Innitiated message var to false
        $message = false;
        // Retrieve username from request
        $username = $request->input('username');
        // Retrieve password from request
        $password = $request->input('password');

        // Validate if user exists
        if ($user = User::where('username', $username)->first()) {
            // Validate if password is correct
            if ($user->validatePassword($password)) {
                $message = [
                    'success' => 'Successfully login',
                ];
            } else {
                $message = [
                    'fail' => 'Incorrect Password',
                ];
            }
        }
        else {
            $message = [
                'fail' => 'Username not found',
            ];
        }

        return view('login', ['message' => $message]);
    }

    /**
     * Register page
     */
    public function register() {
        return view('register');
    }

    /**
     * Login
     *
     * @param  Request
     * @return Response
     */
    public function store(Request $request)
    {
        // Innitiated message var to false
        $message = false;
        // Retrieve username from request
        $username = $request->input('username');
        // Retrieve password from request
        $password = $request->input('password');
        // Retrieve name from request
        $name = $request->input('name');
        // Retrieve email from request
        $email = $request->input('email');
        // Retrieve notes from request
        $notes = $request->input('notes');

        // Validate if user exists
        if ($user = User::where('username', $username)->first()) {
            $message = [
                'fail' => 'User exists',
            ];
        }
        else {
            $user = new User;
            $user->username = $username;
            $user->password = $password;
            $user->name = $name;
            $user->email = $email;
            if (!empty($notes)) {
                $user->notes = $notes;
            }
            $user->save();
            $message = [
                'success' => 'Account succesfully created.'
            ];
        }

        return view('login', ['message' => $message]);
    }
}