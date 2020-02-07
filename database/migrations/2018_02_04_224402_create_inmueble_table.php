<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble', function (Blueprint $table) {
            $table->increments('id_inmueble');
            $table->string('ciudad')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero')->nullable();
            $table->string('zona')->nullable();
            $table->string('num_folio_real')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->boolean('en_garantia')->nullable();
            $table->string('detalle')->nullable();
            $table->double('valor');
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
        Schema::dropIfExists('inmueble');
    }
}
