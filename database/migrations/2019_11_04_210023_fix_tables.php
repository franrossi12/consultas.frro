<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('turnos', function (Blueprint $table) {
            $table->dateTime('fecha_hora')->nullable()->after('cantidad_alumnos');
            $table->dropColumn('fecha');
            $table->dropColumn('hora');
            $table->integer('consulta_alternativa_id')->unsigned()->nullable()->change();

        });

        Schema::rename('turnos_alumnos', 'turnos_cancelados_1');
        Schema::rename('turnos_cancelados', 'turnos_alumnos');
        Schema::rename('turnos_cancelados_1', 'turnos_cancelados');

        Schema::table('turnos_alumnos', function (Blueprint $table) {
            $table->boolean('cancelado')->default(0)->after('notificado');
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
