<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Overrides validateEmail from vendor\laravel\ui\auth-backend\SendsPasswordResetEmails.php
     */
    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email' => 'No user found with that :attribute.',
        ], [
            'email' => 'email address',
        ]);
    }

}
