<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtrltTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ctrlt', function (Blueprint $table) {
            $table->integer('id_persona')->primary();
            $table->string('tabla');
            $table->date('freg')->nullable();
            $table->integer('estado')->nullable();
            $table->string('logs')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ctrlt');
    }
}
