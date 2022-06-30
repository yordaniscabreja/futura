<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestiges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('reputacion_institucional');
            $table->double('practicas_profesionales');
            $table->double('imagen_egresado');
            $table->double('asociaciones_externas');
            $table->double('bolsa_empleo');
            $table->unsignedBigInteger('university_id');

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
        Schema::dropIfExists('prestiges');
    }
};
