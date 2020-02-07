<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciasSolicitanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencias_solicitante', function (Blueprint $table) {
            $table->increments('id_referencia_solicitante');
            $table->string('ap_paterno');
            $table->string('ap_materno')->nullable();
            $table->string('nombre');
            $table->string('parentesco');
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('estado');
            $table->integer('id_persona');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
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
        Schema::dropIfExists('referencias_solicitante');
    }
}
