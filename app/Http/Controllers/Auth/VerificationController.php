<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modelos\Usuario;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
    }

    public function verify($token) {
        $user = Usuario::where('token_verificar', $token)->first();
        if (empty($user)) {
            return redirect('/login')->withErrors(['El token a verificar no es válido.']);
        } else {
            $user->email_verificado = date('Y-m-d H:i:s');
            $user->save();
            return redirect('/login')->with(['message'=>'Email verificado correctamente.']);
        }
    }
}
