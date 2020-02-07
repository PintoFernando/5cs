<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamoBancarioTable extends Migration
{
    /**
     * Run the migrations.     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamo_bancario', function (Blueprint $table) {
            $table->increments('id_pbancario');
            $table->double('importe_original')->nullable();
            $table->integer('duracion_credito')->nullable();
            $table->double('importe_ultimo_pago');
            $table->string('destino_credito')->nullable();
            $table->double('saldo');
            $table->integer('id_entidad_bancaria');
            $table->integer('id_persona');
            $table->integer('id_tcredito');
            $table->foreign('id_entidad_bancaria')->references('id_entidad_bancaria')->on('entidad_bancaria')->onDelete('cascade');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
            $table->foreign('id_tcredito')->references('id_tcredito')->on('tipo_credito')->onDelete('cascade');
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
        Schema::dropIfExists('prestamo_bancario');
    }
}
