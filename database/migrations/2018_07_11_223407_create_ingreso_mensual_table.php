<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresoMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso_mensual', function (Blueprint $table) {
            $table->increments('id_ingreso_mensual');
            $table->string('mes')->nullable();
            $table->string('anio')->nullable();
            $table->double('prestatario')->nullable();
            $table->double('conyugue')->nullable();
            $table->double('otros')->nullable();
            $table->double('codeudores')->nullable();
            $table->double('total_ingreso')->nullable();
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('ingreso_mensual');
    }
}
