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
        Schema::table('bonds', function (Blueprint $table) {
            $table
                ->foreign('academic_program_id')
                ->references('id')
                ->on('academic_programs')
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
        Schema::table('bonds', function (Blueprint $table) {
            $table->dropForeign(['academic_program_id']);
        });
    }
};
