<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInversionesFinancierasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inversiones_financieras', function (Blueprint $table) {
            $table->increments('id_inversion_financiera');
            $table->double('cantidad')->nullable();
            $table->double('porcentaje_patrimonio_empre')->nullable();
            $table->string('nit')->nullable();
            $table->string('nombre_empresa')->nullable();
            $table->double('valor_nominal')->nullable();
            $table->double('valor_mercado');
            $table->string('detalle')->nullable();
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
        Schema::dropIfExists('inversiones_financieras');
    }
}
