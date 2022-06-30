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
        Schema::create('internalizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('intercambios_movilidad');
            $table->double('facilidad_acceso');
            $table->double('relevancia_internacional');
            $table->double('convenios_internacionales');
            $table->double('segundo_idioma');
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
        Schema::dropIfExists('internalizations');
    }
};
