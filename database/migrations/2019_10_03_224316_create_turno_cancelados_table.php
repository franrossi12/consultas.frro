<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnoCanceladosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos_cancelados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consulta_id')->unsigned();
            $table->foreign('consulta_id')->references('id')->on('consultas');
            $table->text('motivo');
            $table->dateTime('fecha_hora')->nullable();
            $table->integer('consulta_alternativa_id')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('turno_cancelados');
    }
}
