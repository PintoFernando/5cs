<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCroquisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('croquis', function (Blueprint $table) {
            $table->increments('id_croquis');
            $table->double('latitud', 8, 8);
            $table->double('longitud', 8, 8);
            $table->string('detalle')->nullable();
            $table->integer('id_categoria_croquis');
            $table->integer('id_persona');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');
            $table->foreign('id_categoria_croquis')->references('id_categoria_croquis')->on('categoria_croquis')->onDelete('cascade');
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
        Schema::dropIfExists('croquis');
    }
}
