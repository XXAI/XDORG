<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donadores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->date('fecha_nacimiento');
            $table->string('curp',18);
            $table->string('genero',1);
            $table->string('codigo_postal');
            $table->string('ciudad');
            $table->bigInteger('estado_id');
            $table->string('email');
            $table->string('telefono_contacto');
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
        Schema::dropIfExists('donadores');
    }
}
