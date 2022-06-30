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
        Schema::create('wellnesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('orientacion_psicologia');
            $table->double('actividades_deportivas');
            $table->double('actividades_culturales');
            $table->double('plan_covid19');
            $table->double('felicidad_entorno');
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
        Schema::dropIfExists('wellnesses');
    }
};
