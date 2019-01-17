<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        // Get user data
    
        $user = \App\Domain\User::where('username', $username)
                ->where('disabled', false)
                ->first();

        
        // Check
        if (!empty($user) && Hash::check($password, $user->password)) {
            // logged in
            Toastr::success('', 'Logeo exitoso', ["positionClass" => "toast-bottom-right"]);
            return view('home');
        } else {
            // Eorror
            Toastr::error('Credenciales invalidas', 'Error de autenticación', ["positionClass" => "toast-bottom-right"]);
            return view('auth.login');
        }
    }
}