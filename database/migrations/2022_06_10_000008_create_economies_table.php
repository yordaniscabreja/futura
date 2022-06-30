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
        Schema::create('economies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('financiacion');
            $table->double('becas_auxilio');
            $table->double('costos_calidad');
            $table->double('costos_manutencion');
            $table->double('costos_parqueadero');
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
        Schema::dropIfExists('economies');
    }
};
