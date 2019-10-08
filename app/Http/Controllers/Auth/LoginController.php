<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {
        if (Auth::attempt($request->except(['_token'])) ) {
            $redirect_after = redirectAfterLogin();
            if (empty(currentUser()->email_verificado))
                return Redirect::back()->withErrors(['Email no verificado.']);

            return redirect($redirect_after);
        }
        return Redirect::back()->withErrors(['Credenciales Incorrectas!']);
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
}
