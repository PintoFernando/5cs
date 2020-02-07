<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCtrolAnalisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ctrol_analisis', function (Blueprint $table) {
            $table->increments('id_detalle_ctrol_analisis');
            $table->boolean('socio_solicitud_credito')->nullable();
            $table->boolean('ga_solicitud_credito')->nullable();
            $table->boolean('informe_credito_vobo_gerencia')->nullable();
            $table->boolean('analisis_inf_ecofinanciero')->nullable();
            $table->boolean('flujo_caja')->nullable();
            $table->boolean('estado_resultados')->nullable();
            $table->boolean('otros_isntrumentos_anxs')->nullable();
            $table->boolean('declaracion_patrimonial')->nullable();
            $table->boolean('constancia_actividad_laboral')->nullable();
            $table->boolean('boleta_pago')->nullable();
            $table->boolean('nit_licencia')->nullable();
            $table->boolean('certificaciones_otros')->nullable();
            $table->boolean('respaldo_de_recep_tarjeta')->nullable();
            $table->boolean('formulario_apertura_cuenta')->nullable();
            $table->boolean('historico_estracto_deuda_coop')->nullable();
            $table->boolean('formulario_inspeccion_vehiculo')->nullable();
            $table->boolean('formulario_recepcion_devolucion')->nullable();
            $table->boolean('informe_avaluacion_bienes')->nullable();
            $table->boolean('tarjeta_cuenta_ahorros');
            $table->integer('id_control_documentos');
            $table->foreign('id_control_documentos')->references('id_control_documentos')->on('control_documentos')->onDelete('cascade');
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
        Schema::dropIfExists('detalle_ctrol_analisis');
    }
}
