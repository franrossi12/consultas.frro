<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OlvideContraseñaMail;
use App\Modelos\PasswordReset;
use App\Modelos\Usuario;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Mockery\Generator\StringManipulation\Pass\Pass;

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
     * Envio email para resetear contraseña
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function send(Request $request){
        $usuario = Usuario::where('email', $request->get('email'))->first();
        if (!empty($usuario)) {
            $token = PasswordReset::create(['email' => $usuario->email, 'token' => Str::random(32)]);
//            Mail::to($usuario->email)->send(new OlvideContraseñaMail($usuario->nombre, $token->token));

            $datos = ['token' => $token->token, 'nombre' => $usuario->nombre];
            Mail::send('emails.forgot-password', $datos, function ($message) use ($usuario) {
                $message->from('consultasfrro@gmail.com', 'Consultas Frro');
                $message->to('rossifrancisco12@gmail.com')
                    ->subject('Resetear Contraseña');
            });
            return view('pages.auth.login')
                ->with(['message'=>'Se ha enviado a su casilla de correo el código para resetar su contraseña.']);
        } else {
            return redirect('/olvide-contraseña')->withErrors(['El email ingresado no se encuentra en la base de datos.']);
        }
    }

    /**
     * Valida que la url para resetar contraseña sea valida si es asi devuelve el usuario
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function form($token) {
        $password = PasswordReset::where('token', $token)->first();
        if (empty($password)) {
            return redirect('/olvide-contraseña')->withErrors(['El token ingresado no es válido.']);
        } else {
            $usuario = Usuario::where('email', $password->email)->first();
            return view('pages.auth.forgot')->with(['usuario' => $usuario]);
        }
    }
}
