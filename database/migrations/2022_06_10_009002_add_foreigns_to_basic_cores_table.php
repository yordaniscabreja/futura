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
        Schema::table('basic_cores', function (Blueprint $table) {
            $table
                ->foreign('knowledge_area_id')
                ->references('id')
                ->on('knowledge_areas')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('basic_cores', function (Blueprint $table) {
            $table->dropForeign(['knowledge_area_id']);
        });
    }
};
