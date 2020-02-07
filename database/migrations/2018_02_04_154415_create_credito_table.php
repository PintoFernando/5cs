<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credito', function (Blueprint $table) {
            $table->increments('id_credito');
            $table->date('fecha_solicitud');
            $table->double('monto_solicitado');
            $table->double('interes_nominal')->nullable();
            $table->integer('plazo_meses');
            $table->integer('dia_pago');
            $table->integer('id_tipo_moneda');
            $table->integer('id_forma_pago');
            $table->integer('id_periodo_pago');
            $table->integer('id_tamortizacion');
            $table->integer('id_tcredito');
            $table->integer('id_destino_credito');
            $table->boolean('desembolsado')->nullable();
            $table->boolean('estado')->nullable();
            $table->integer('id_persona');
            $table->foreign('id_tipo_moneda')->references('id_tipo_moneda')->on('tipo_moneda')->onDelete('cascade');
            $table->foreign('id_forma_pago')->references('id_forma_pago')->on('forma_pago')->onDelete('cascade');
            $table->foreign('id_periodo_pago')->references('id_periodo_pago')->on('tipo_periodo_pago')->onDelete('cascade');
            $table->foreign('id_tamortizacion')->references('id_tamortizacion')->on('tipo_amortizacion')->onDelete('cascade');
            $table->foreign('id_tcredito')->references('id_tcredito')->on('tipo_credito')->onDelete('cascade');
            $table->foreign('id_destino_credito')->references('id_destino_credito')->on('destino_credito')->onDelete('cascade');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**microcredito
     consumo
     libre disponibilidad
     vivienda

     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
        Schema::dropIfExists('credito');
    }
}
