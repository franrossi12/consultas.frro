<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modelos\PasswordReset;
use App\Modelos\Usuario;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

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

    public function sendResetLinkEmail(Request $request){
        // todo falta mandar mail
    }

    public function form($token) {
        $password = PasswordReset::where('token', $token)->first();
        if (empty($password)) {
            return redirect('/olvide-contraseña')->withErrors(['El token ingresado no es válido.']);
        } else {
            $usuario = Usuario::where('email', $password->email)->first();
            return redirect('/olvide-contraseña')->with(['usuario' => $usuario]);
        }
    }
}
