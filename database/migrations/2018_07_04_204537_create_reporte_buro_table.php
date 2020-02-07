<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReporteBuroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_buro', function (Blueprint $table) {
            $table->increments('id_reporte_buro');
            $table->integer('tiempo_maximo_mora');
            $table->integer('id_persona');
            $table->integer('id_buro');
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade');  
            $table->foreign('id_buro')->references('id_buro')->on('buros')->onDelete('cascade'); 
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
        Schema::dropIfExists('reporte_buro');
    }
}
