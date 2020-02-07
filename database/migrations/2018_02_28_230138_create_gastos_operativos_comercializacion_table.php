<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateGastosOperativosComercializacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_operativos_comercializacion', function (Blueprint $table) {
            $table->increments('id_gastos_operativos');
            $table->double('combustible')->nullable();
            $table->double('deposito_almacen')->nullable();
            $table->double('energia_electrica')->nullable();
            $table->double('agua')->nullable();
            $table->double('gas')->nullable();
            $table->double('telefono')->nullable();
            $table->double('impuestos')->nullable();
            $table->double('alquiler')->nullable();
            $table->double('cuidado_sereno')->nullable();
            $table->double('transporte')->nullable();
            $table->double('mantenimiento')->nullable();
            $table->double('publicidad')->nullable();
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
        Schema::dropIfExists('gastos_operativos_comercializacion');
    }
}
