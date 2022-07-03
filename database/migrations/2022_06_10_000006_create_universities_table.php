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
        Schema::create('universities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('name');
            $table->boolean('oficial');
            $table->boolean('acreditada');
            $table->unsignedBigInteger('city_id');
            $table->boolean('principal');
            $table->string('url');
            $table->longText('direccion');
            $table->timestamp('fundada_at');
            $table->double('egresados');
            $table->text('general_description');
            $table->string('logo')->nullable();
            $table->string('background_image');
            $table->string('about_video_url');

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
        Schema::dropIfExists('universities');
    }
};
