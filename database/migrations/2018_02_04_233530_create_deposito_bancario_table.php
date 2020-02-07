<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositoBancarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposito_bancario', function (Blueprint $table) {
            $table->increments('id_dbancario');
            $table->string('numero_cuenta')->nullable();
            $table->string('detalle')->nullable();
            $table->double('saldo');
            $table->integer('id_entidad_bancaria');
            $table->integer('id_tipo_deposito');
            $table->integer('id_persona');
            $table->foreign('id_entidad_bancaria')->references('id_entidad_bancaria')->on('entidad_bancaria')->onDelete('cascade');
            $table->foreign('id_tipo_deposito')->references('id_tipo_deposito')->on('tipo_deposito')->onDelete('cascade');
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
        Schema::dropIfExists('deposito_bancario');
    }
}
