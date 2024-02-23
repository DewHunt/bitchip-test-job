<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        $login = request()->input('login');
        $fieldType = filter_var($login,FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    public function login() {
        $login = request()->input('login');
        $fieldType = filter_var($login,FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
        request()->merge([$fieldType => $login]);
        $credentials = request()->validate([
            $fieldType => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect(route('admin.index'));
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        $this->guard()->logout();

        return redirect(route('login'));
    }
}
