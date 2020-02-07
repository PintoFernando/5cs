<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosFamiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_familiares', function (Blueprint $table) {
            $table->increments('id_gastos_familiares');
            $table->double('alimentacion')->nullable();
            $table->double('energia_electrica')->nullable();
            $table->double('agua')->nullable();
            $table->double('telefono')->nullable();
            $table->double('gas')->nullable();
            $table->double('impuestos')->nullable();
            $table->double('alquileres')->nullable();
            $table->double('educacion')->nullable();
            $table->double('transporte')->nullable();
            $table->double('salud')->nullable();
            $table->double('empleada')->nullable();
            $table->double('diversion')->nullable();
            $table->double('vestimenta')->nullable();
            $table->double('otros')->nullable();
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
        Schema::dropIfExists('gastos_familiares');
    }
}
