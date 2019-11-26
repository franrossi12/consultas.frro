<?php

use App\Modelos\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carrera = Carrera::where('descripcion', 'ISI')->first();
        if (empty($carrera)) {
            $a = new Carrera(['descripcion' => 'ISI']);
            $a->save();
        }
    }
}
