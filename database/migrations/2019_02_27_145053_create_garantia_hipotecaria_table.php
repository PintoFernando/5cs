<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarantiaHipotecariaTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('garantia_hipotecaria', function (Blueprint $table) {
            $table->increments('id_garantia_hipotecaria');
            $table->string('nombre_ap_propietario')->nullable();
            $table->string('vivi_tipo')->nullable();
            $table->string('vivi_ubicacion_bien')->nullable();
            $table->string('vivi_libro_ddrr')->nullable();
            $table->string('vivi_matricula')->nullable();
            $table->string('vivi_partida')->nullable();
            $table->string('vivi_designacion')->nullable();
            $table->double('vivi_superficie')->nullable();
            $table->string('vivi_linderos')->nullable();
            $table->double('vivi_valor_comercial')->nullable();
            $table->double('vivi_valor_avaluo')->nullable();
            $table->string('vivi_empresa_valuadora')->nullable();
            $table->string('vehi_tipo')->nullable();
            $table->string('vehi_subtipo')->nullable();
            $table->string('vehi_marca')->nullable();
            $table->string('vehi_modelo')->nullable();
            $table->string('vehi_rua')->nullable();
            $table->string('vehi_placa')->nullable();
            $table->string('vehi_clase')->nullable();
            $table->string('vehi_num_motor')->nullable();
            $table->string('vehi_chasis')->nullable();
            $table->string('vehi_procedencia')->nullable();
            $table->string('vehi_cilindrada')->nullable();
            $table->string('vehi_num_poliza')->nullable();
            $table->string('vehi_color')->nullable();
            $table->double('vehi_valor_comercial')->nullable();
            $table->double('vehi_valor_avaluo')->nullable();
            $table->string('vehi_empresa_valuadora')->nullable();
            $table->string('depo_nombres_titular_dpf1')->nullable();
            $table->string('depo_nombres_titular_dpf2')->nullable();
            $table->string('depo_entidad_emisora')->nullable();
            $table->string('depo_num_dpf')->nullable();
            $table->double('depo_monto')->nullable();
            $table->date('depo_fecha_apertura')->nullable();
            $table->date('depo_fecha_vencimiento')->nullable();
            $table->integer('id_credito');
            $table->foreign('id_credito')->references('id_credito')->on('credito')->onDelete('cascade');
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
        Schema::dropIfExists('garantia_hipotecaria');
    }
}
