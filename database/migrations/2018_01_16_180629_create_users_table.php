<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('users', function (Blueprint $table) {
            $table->increments('id_users');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');            
            $table->string('imagen')->nullable();            
            $table->integer('id_rol');
            $table->integer('id_persona')->nullable();
            $table->foreign('id_rol')->references('id_rol')->on('rol')->onDelete('cascade'); 
            $table->foreign('id_persona')->references('id_persona')->on('persona')->onDelete('cascade'); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
