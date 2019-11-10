<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTurnosCancelados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turnos_cancelados', function (Blueprint $table) {
            $table->dateTime('fecha_hora')->nullable()->after('consulta_id');
            $table->dropColumn('fecha');
            $table->dropColumn('hora');
            $table->dropForeign('turnos_alumnos_alumno_id_foreign');
            $table->dropColumn('alumno_id');
            $table->integer('consulta_alternativa_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
