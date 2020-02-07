<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_persona', function (Blueprint $table) {
            $table->increments('id_detalle_persona');
            $table->string('ocupacion')->nullable();
            $table->string('cargo')->nullable();
            $table->date('tiempo_trabajo')->nullable();
            $table->string('nombre_institucion')->nullable();
            $table->string('calle_principal')->nullable();
            $table->string('calle_secundaria')->nullable();
            $table->string('telefono')->nullable();
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
        Schema::dropIfExists('detalle_persona');
    }
}
