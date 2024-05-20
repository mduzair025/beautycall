<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/user';

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
            'Name'        => ['required', 'max:255'],
            'Username'    => ['nullable', 'max:255'],
            'Email'       => ['required', 'email', 'max:255', 'unique:users'],
            'Password'    => ['required', 'min:8'],
            'Surname'     => ['nullable', 'max:255'],
            'Country'     => ['nullable', 'max:255'],
            'City'        => ['nullable', 'max:255'],
            'Address'     => ['nullable', 'max:255'],
            'PostalCode'  => ['nullable', 'max:255'],
            'PhoneNumber' => ['nullable', 'max:255'],
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

        return User::create([
            'Name'        => $data['Name'],
            'Username'    => $data['Username'],
            'Surname'     => $data['Surname'],
            'Email'       => $data['Email'],
            'Password'    => Hash::make($data['Password']),
            'Country'     => $data['Country'],
            'City'        => $data['City'],
            'Address'     => $data['Address'],
            'PostalCode'  => $data['PostalCode'],
            'PhoneNumber' => $data['PhoneNumber'],
        ]);
    }
}
