<?php

use Illuminate\Database\Seeder;

class DiasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dias = [
            [ "numero" => 1, "desc" => "Lunes" ],
            [ "numero" => 2, "desc" => "Martes" ],
            [ "numero" => 3, "desc" => "Miercoles" ],
            [ "numero" => 4, "desc" => "Jueves" ],
            [ "numero" => 5, "desc" => "Viernes" ],
            [ "numero" => 6, "desc" => "Sabado" ],
            [ "numero" => 0, "desc" => "Domingo" ]

        ];
        foreach ($dias as $dia) {
            $dia_db = \App\Modelos\Dia::where('numero', $dia["numero"])->first();

            if (empty($dia_db)) {
                $dia_db = new \App\Modelos\Dia([ 'numero'    => $dia["numero"],
                'descripcion'  => $dia["desc"]
                ]);
                $dia_db->save();
            }
        }
    }
}
