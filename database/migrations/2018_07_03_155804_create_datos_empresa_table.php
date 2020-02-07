<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->increments('id_datos_empresa');
            $table->string('nombre_empresa');
            $table->string('actividad_empresa');
            $table->string('antiguedad_empresa');
            $table->string('ciudad_empresa');
            $table->string('provincia_empresa');
            $table->string('zona_empresa');
            $table->string('direccion_empresa');
            $table->string('telefono_empresa')->nullable();
            $table->string('cargo_en_empresa');
            $table->string('antiguedad_en_cargo');
            $table->string('horario_trabajo');
            $table->string('dias_trabajo');
            $table->integer('id_persona');
            $table->integer('id_afp');
            $table->integer('id_tc');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
            $table->foreign('id_afp')->references('id_afp')->on('afp')->onDelete('cascade');
            $table->foreign('id_tc')->references('id_tc')->on('tipo_contrato')->onDelete('cascade');            
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
        Schema::dropIfExists('datos_empresa');
    }
}
