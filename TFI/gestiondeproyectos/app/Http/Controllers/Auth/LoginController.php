<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Application\Services\UserService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
    
        $user = $this->service->findOne($username);

        if (!empty($user) && Hash::check($password, $user->password)) {
            Toastr::success('', 'Logeo exitoso', ["positionClass" => "toast-bottom-right"]);
            Auth::login($user, true);
            return redirect('home');
        } else {
            Toastr::error('Credenciales invalidas', 'Error de autenticación', ["positionClass" => "toast-bottom-right"]);
            return view('auth.login');
        }
    }
}