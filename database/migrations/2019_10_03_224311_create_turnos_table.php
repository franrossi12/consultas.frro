<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('consulta_id')->unsigned()->nullable();
            $table->foreign('consulta_id')->references('id')->on('consultas');

            $table->integer('consulta_alternativa_id')->unsigned()->nullable();
            $table->foreign('consulta_alternativa_id')->references('id')->on('consultas_alternativas');
            $table->dateTime('fecha_hora')->nullable();

            $table->integer('cantidad_alumnos');
            $table->boolean('cancelado')->default(0);

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
        Schema::dropIfExists('turnos');
    }
}
