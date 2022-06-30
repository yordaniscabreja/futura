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
        Schema::create('academic_programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('name');
            $table->string('snies_code');
            $table->boolean('acreditado');
            $table->integer('credits');
            $table->integer('numero_duracion');
            $table->string('periodo_duracion');
            $table->string('jornada');
            $table->string('precio');
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('basic_core_id');
            $table->unsignedBigInteger('academic_level_id');
            $table->unsignedBigInteger('modality_id');
            $table->unsignedBigInteger('education_level_id');

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
        Schema::dropIfExists('academic_programs');
    }
};
