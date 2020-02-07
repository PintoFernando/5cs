<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCtrolDocumentacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ctrol_cocumentacion', function (Blueprint $table) {
            $table->increments('id_detalle_ctrol_documentacion');
            $table->boolean('reconocimiento_firmas')->nullable();
            $table->boolean('poder_para_retencion')->nullable();
            $table->boolean('declaracion_bienes_notariado')->nullable();
            $table->boolean('escritura_publica')->nullable();
            $table->boolean('gravamen_hipoteca')->nullable();
            $table->boolean('inf_rapida_gravamen_hipotecario')->nullable();
            $table->boolean('gravamen_hipoteca_vehi')->nullable();
            $table->boolean('gravamen_line_telef')->nullable();
            $table->boolean('certificado_deposito_pla')->nullable();
            $table->boolean('autorizacion_de_cuenta_caja')->nullable();
            $table->boolean('poliza_seguros')->nullable();
            $table->boolean('informe_juridico')->nullable();
            $table->boolean('documento_inmueble')->nullable();
            $table->boolean('documento_vehiculo')->nullable();
            $table->boolean('documento_otras_garanti')->nullable();
            $table->boolean('documento_inmueble_custodia')->nullable();
            $table->boolean('documento_vehiculo_custodia')->nullable();
            $table->boolean('documento_otras_garantias_custodia')->nullable();
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
        Schema::dropIfExists('detalle_ctrol_cocumentacion');
    }
}
