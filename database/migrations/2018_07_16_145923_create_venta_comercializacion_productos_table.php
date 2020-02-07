<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentaComercializacionProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venta_comercializacion_productos', function (Blueprint $table) {
            $table->increments('id_venta_comercializacion');
            $table->string('producto');
            $table->integer('cantidad');
            $table->string('unidad_medida');
            $table->double('c_costo_unitario');
            $table->double('c_costo_total');
            $table->double('v_precio_unitario');
            $table->double('v_precio_total');
            $table->double('utilidad');
            $table->double('porcentaje');
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
        Schema::dropIfExists('venta_comercializacion_productos');
    }
}
