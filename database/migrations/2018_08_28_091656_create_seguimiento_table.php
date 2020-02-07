<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento', function (Blueprint $table) {
            $table->increments('id_seguimiento');
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_fin')->nullable();
            $table->integer('usuario_destino')->nullable();
            $table->integer('area_destino')->nullable();
            $table->string('observaciones')->nullable();
            $table->boolean('completado')->nullable();
            $table->integer('id_credito');
            $table->integer('id_area');
            $table->integer('id_users');
            $table->foreign('id_credito')->references('id_credito')->on('credito')->onDelete('cascade'); //integridad referencial
            $table->foreign('id_area')->references('id_area')->on('area')->onDelete('cascade');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('seguimiento');
    }
}
