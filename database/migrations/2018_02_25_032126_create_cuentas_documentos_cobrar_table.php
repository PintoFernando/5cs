<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuentasDocumentosCobrarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas_documentos_cobrar', function (Blueprint $table) {
            $table->increments('id_cuentas_docu');
            $table->string('nit')->nullable();
            $table->string('nombre_razon_social')->nullable();
            $table->string('concepto')->nullable();
            $table->double('saldo');  
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
        Schema::dropIfExists('cuentas_documentos_cobrar');
    }
}
