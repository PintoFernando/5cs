<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateControlDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_documentos', function (Blueprint $table) {
            $table->increments('id_control_documentos');
            $table->boolean('socio_ci')->nullable();
            $table->boolean('ga_ci')->nullable();
            $table->boolean('socio_infocred')->nullable();
            $table->boolean('ga_infocred')->nullable();
            $table->boolean('constancia_inf_obli')->nullable();
            $table->boolean('socio_certifica_obli_cred')->nullable();
            $table->boolean('ga_certica_obli_cre')->nullable();
            $table->boolean('socio_fac_servi_ba')->nullable();
            $table->boolean('ga_fac_servi_ba')->nullable();
            $table->boolean('socio_croquis')->nullable();
            $table->boolean('ga_croquis')->nullable();
            $table->boolean('socio_constancia_laboral')->nullable();
            $table->boolean('ga_constancia_laboral')->nullable();
            $table->boolean('orden_desembolso')->nullable();
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
        Schema::dropIfExists('control_documentos');
    }
}
