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
        Schema::create('life_styles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('ambiente');
            $table->double('diversion_ocio');
            $table->double('descanso_relax');
            $table->double('cultura_ecologica');
            $table->double('servicio_estudiante');
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
        Schema::dropIfExists('life_styles');
    }
};
