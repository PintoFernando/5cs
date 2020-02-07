<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGarantiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garantia', function (Blueprint $table) {
            $table->increments('id_garantia');
            $table->integer('id_credito');
            $table->integer('id_tipo_garantia');
            $table->foreign('id_credito')->references('id_credito')->on('credito')->onDelete('cascade');
            $table->foreign('id_tipo_garantia')->references('id_tipo_garantia')->on('tipo_garantia')->onDelete('cascade');
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
        Schema::dropIfExists('garantia');
    }
}
