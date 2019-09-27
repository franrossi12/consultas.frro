<?php

use App\Modelos\Perfil;
use Illuminate\Database\Seeder;

class PerfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_perfil = Perfil::where('tag', 'ADMIN')->first();
        if (empty($admin_perfil)) {
            $a = new Perfil(['tag' => 'ADMIN', 'descripcion' => 'Perfil Administrador']);
            $a->save();
        }
        $alumno_perfil = Perfil::where('tag', 'ALUMNO')->first();
        if (empty($alumno_perfil)) {
            $a = new Perfil(['tag' => 'ALUMNO', 'descripcion' => 'Perfil Alumno']);
            $a->save();
        }
        $profesor_perfil = Perfil::where('tag', 'PROFESOR')->first();
        if (empty($profesor_perfil)) {
            $a = new Perfil(['tag' => 'PROFESOR', 'descripcion' => 'Perfil Profesor']);
            $a->save();
        }
    }
}
