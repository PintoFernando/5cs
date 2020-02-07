<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadEconomicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_economica', function (Blueprint $table) {
        $table->increments('id_actividad_economica');
        $table->string('ciudad_ae');
        $table->string('provincia_ae');
        $table->string('zona_ae')->nullable();
        $table->string('direccion_ae');
        $table->string('telefono_ae')->nullable();
        $table->string('actividad_qrealiza');
        $table->string('nit_ae')->nullable();
        $table->string('horario_trabajo_ae');
        $table->string('dias_trabajo_ae');     
        $table->date('antiguedad_trabajo_ae');       
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
        Schema::dropIfExists('actividad_economica');
    }
}
