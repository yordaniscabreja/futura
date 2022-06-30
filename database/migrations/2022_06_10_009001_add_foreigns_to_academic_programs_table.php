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
        Schema::table('academic_programs', function (Blueprint $table) {
            $table
                ->foreign('university_id')
                ->references('id')
                ->on('universities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('basic_core_id')
                ->references('id')
                ->on('basic_cores')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('academic_level_id')
                ->references('id')
                ->on('academic_levels')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('modality_id')
                ->references('id')
                ->on('modalities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('education_level_id')
                ->references('id')
                ->on('education_levels')
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
        Schema::table('academic_programs', function (Blueprint $table) {
            $table->dropForeign(['university_id']);
            $table->dropForeign(['basic_core_id']);
            $table->dropForeign(['academic_level_id']);
            $table->dropForeign(['modality_id']);
            $table->dropForeign(['education_level_id']);
        });
    }
};
