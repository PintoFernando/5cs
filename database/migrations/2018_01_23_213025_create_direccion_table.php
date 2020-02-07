<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
         
            $table->increments('id_direccion');
            $table->string('direc_numero')->nullable();
            $table->string('departamento')->nullable();
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('localidad')->nullable();
            $table->string('zona')->nullable();
            $table->string('distrito')->nullable();
            $table->string('barrio')->nullable();
            $table->string('cll_principal');
            $table->string('cll_secundaria')->nullable();
            $table->date('tiempo_residencia');
            $table->integer('id_persona');
            $table->integer('id_tipo_vivienda');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
            $table->foreign('id_tipo_vivienda')->references('id_tipo_vivienda')->on('tipo_vivienda')->onDelete('cascade');
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
        Schema::dropIfExists('direccion');
    }
}
