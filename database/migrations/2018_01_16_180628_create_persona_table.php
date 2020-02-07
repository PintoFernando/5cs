<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('persona', function (Blueprint $table) {
       $table->increments('id_persona');
       $table->string('ci');
       $table->string('nombre');
       $table->string('ap_paterno');
       $table->string('ap_materno')->nullable();
       $table->string('ap_casada')->nullable();
       $table->date('fec_nac');
       $table->string('lugar_nac')->nullable();//modificar en create para que sea require
       $table->string('departamento_nac')->nullable();//modificar en create para que sea require
       $table->string('ciudad_nac')->nullable();//modificar en create para que sea require
       $table->string('provincia_nac')->nullable();//modificar en create para que sea require
       $table->string('genero');
       $table->string ('celular');
       $table->integer('dependientes');
       $table->integer('num_socio')->nullable();
       $table->integer('id_nacionalidad');
       $table->integer('id_estado_civil');
       $table->integer('id_profesion');
       $table->integer('id_ext')->nullable();
       $table->integer('estado')->nullable();
       $table->foreign('id_profesion')->references('id_profesion')->on('profesion')->onDelete('cascade'); 
       $table->foreign('id_estado_civil')->references('id_estado_civil')->on('estado_civil')->onDelete('cascade');      
       $table->foreign('id_nacionalidad')->references('id_nacionalidad')->on('nacionalidad')->onDelete('cascade');         
       $table->foreign('id_ext')->references('id_ext')->on('extension_ci')->onDelete('cascade');
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
        Schema::dropIfExists('persona');
    }
}
