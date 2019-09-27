<?php

use App\Modelos\Perfil;
use App\Modelos\Usuario;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_perfil = Perfil::where('tag', 'ADMIN')->first();
        $alumno_perfil = Perfil::where('tag', 'ALUMNO')->first();
        $profesor_perfil = Perfil::where('tag', 'PROFESOR')->first();

        $usuario_admin = Usuario::where('email', 'admin@consultas.frro.com')->first();
        if (empty($usuario_admin)) {
            $a = new Usuario([  'nombre'    => 'Admin',
                                'email'     => 'admin@consultas.frro.com',
                                'password'  => bcrypt('frro123'),
                                'perfil_id' => $admin_perfil->id
                            ]);
            $a->save();
        }
        $usuario_alumno = Usuario::where('email', 'alumno@consultas.frro.com')->first();
        if (empty($usuario_alumno)) {
            $a = new Usuario([  'nombre'    => 'Alumno',
                                'apellido'  => 'Test',
                                'email'     => 'alumno@consultas.frro.com',
                                'password'  => bcrypt('frro123'),
                                'perfil_id' => $alumno_perfil->id
                            ]);
            $a->save();
        }
        $usuario_profesor = Usuario::where('email', 'profesor@consultas.frro.com')->first();
        if (empty($usuario_profesor)) {
            $a = new Usuario([  'nombre'    => 'Profesor',
                                'apellido'  => 'Test',
                                'email'     => 'profesor@consultas.frro.com',
                                'password'  => bcrypt('frro123'),
                                'perfil_id' => $profesor_perfil->id
                            ]);
            $a->save();
        }
    }
}
