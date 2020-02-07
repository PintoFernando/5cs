<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManoObraMensualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mano_obra_mensual', function (Blueprint $table) {
            $table->increments('id_mano_obra');
            $table->string('descripcion_cargo')->nullable();
            $table->integer('num_personas');
            $table->double('sueldo_mensual');
            $table->double('total_mano_obra');
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
        Schema::dropIfExists('mano_obra_mensual');
    }
}
