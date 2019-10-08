<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Modelos\Usuario;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password'              => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ], $this->messages());
    }

    protected function messages() {
        return [
            'password.required'                 => "La contraseña es requerida.",
            'password.min'                      => "La contraseña debe contener al menos 8 caracteres.",
            'password_confirmation.required'    => "La confirmación de la contraseña es requerida.",
            'password_confirmation.same'        => "La confirmación de la contraseña debe coincidir con la contraseña.",
        ];
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function resetPassword(Request $request) {
        $data = $request->all();
        $validation = $this->validator($data);
        if ($validation->fails())  {
            return redirect()->back()->with(['errors' => $validation->errors()]);
        } else {
            $u = Usuario::where('email', $data["email"])->first();
            $u->password = bcrypt($data["password"]);
            $u->save();
            return redirect('/login')->with(['message'=>'Contraseña actualizada correctamente.']);
        }
    }
}
