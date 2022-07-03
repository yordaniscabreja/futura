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
        Schema::create('zones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('facilidad_transporte');
            $table->double('seguridad_zona');
            $table->double('opciones_parqueo');
            $table->double('opciones_vivir');
            $table->double('opciones_comer');
            $table->unsignedBigInteger('academic_program_id');

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
        Schema::dropIfExists('zones');
    }
};
