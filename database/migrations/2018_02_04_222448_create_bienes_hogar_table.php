<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienesHogarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienes_hogar', function (Blueprint $table) {
            $table->increments('id_bien_hogar');
            $table->string('articulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('marca')->nullable();
            $table->string('color')->nullable();
            $table->string('modelo')->nullable();
            $table->string('estado')->nullable();
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
        Schema::dropIfExists('bienes_hogar');
    }
}
