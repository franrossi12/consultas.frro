<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmarPasswordEmail;
use App\Modelos\Perfil;
use App\Modelos\Usuario;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = '/home';

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
            'nombre'                => ['required', 'max:255'],
            'apellido'              => ['required', 'max:255'],
            'email'                 => ['required', 'email', 'max:255', 'unique:usuarios'],
            'password'              => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
        ], $this->messages());
    }

    protected function messages() {
        return [
            'nombre.required'                   => "El nombre es requerido.",
            'nombre.max'                        => "El nombre debe tener menos de 255 caracteres.",
            'apellido.required'                 => "El apellido es requerido.",
            'apellido.max'                      => "El apellido debe tener menos de 255 caracteres.",
            'email.required'                    => "El email es requerido.",
            'email.max'                         => "El email debe tener menos de 255 caracteres.",
            'email.email'                       => "El email no posee el formato correcto.",
            'email.unique'                      => "El email ya se encuentra en el sistema.",
            'password.required'                 => "La contraseña es requerida.",
            'password.min'                      => "La contraseña debe contener al menos 8 caracteres.",
            'password_confirmation.required'    => "La confirmación de la contraseña es requerida.",
            'password_confirmation.same'        => "La confirmación de la contraseña debe coincidir con la contraseña.",
        ];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $data = $request->all();
        $validation = $this->validator($data);
        $perfil_alumno = Perfil::where('tag', 'ALUMNO')->first();
        if ($validation->fails())  {
            return redirect()->back()->with(['errors' => $validation->errors()]);
        } else {
            $user = Usuario::create([
                'nombre'            => $data['nombre'],
                'apellido'          => $data['apellido'],
                'email'             => $data['email'],
                'password'          => Hash::make($data['password']),
                'perfil_id'         => $perfil_alumno->id,
                'token_verificar'   => Str::random(32)
            ]);
            Mail::to($data['email'])->send(new ConfirmarPasswordEmail($user));
        }
        return view('pages.auth.login')->with(['message'=>'Debe verificar su mail. Se ha enviado a su casilla de correo el código de confirmación']);

    }
}
