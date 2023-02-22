<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_certificate_criteria', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_course_id');
            $table->integer('certificate_id');
            $table->integer('course_certificate_criteria_id');
            $table->tinyInteger('value');

            $table->index('user_id');
            $table->index('user_course_id');
            $table->index('certificate_id');
            // $table->index('course_certificate_criteria_id', 'ccci');
            $table->index('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_course_certificate_criteria');
    }
};
