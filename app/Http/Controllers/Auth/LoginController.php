<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        $admin = Administrator::where('Email', $request->Email)->first();

        if ($admin && Hash::check($request->Password, $admin->Password)) {

            session(['admin' => $admin]);
            return redirect()->to('salon'); // or wherever you want to redirect

        } else {
            $user = User::where('Email', $request->Email)->first();
            if ($user && Hash::check($request->Password, $user->Password)) {
                Auth::login($user);
                return redirect()->to('user'); // or wherever you want to redirect
            } else {
                throw ValidationException::withMessages([
                    'Email' => [trans('auth.failed')],
                ]);
            }
        }
    }
}
