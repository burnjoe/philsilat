<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Coach;
use App\Models\SignUpCode;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'last_name' => ['required', 'string', 'min:2', 'max:50'],
            'first_name' => ['required', 'string', 'min:2', 'max:50'],
            'phone' => ['required', 'regex:/^09\d{9}$/', 'unique:admins', 'unique:coaches'],
            'sex' => ['required', 'in:Male,Female'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'signup_code' => ['required', 'string', 'exists:sign_up_codes,code'],
        ], [
            'phone.regex' => 'The :attribute field must be in a valid format. (e.g. 0921XXXXXXX)',
            'signup_code.exists' => 'The :attribute is invalid.'
        ], [
            'email' => 'email address',
            'phone' => 'phone number',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Remove sign up code in Codes table
        $signupCode = SignUpCode::where('code', $data['signup_code'])->first();
        $role = $signupCode->role;
        $signupCode->delete();
        $class = Coach::class;

        if($role == 'admin') {
            $class = Admin::class;
        }

        $profile = $class::create([
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'phone' => $data['phone'],
            'sex' => $data['sex'],
        ]);

        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profileable_id' => $profile->id,
            'profileable_type' => $class,
        ])->assignRole($role);
    }

    /**
     * Overrides showRegistrationForm() from vendor\laravel\ui\auth-backend\RegistersUsers.php
     */
    public function showRegistrationForm()
    {
        return view('auth.signup');
    }

    /**
     * Overrides register() from vendor\laravel\ui\auth-backend\RegistersUsers.php
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect()->route('login');
    }
}
