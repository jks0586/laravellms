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
        Schema::create('course_certificate_criteria', function (Blueprint $table) {
            $table->id();
            $table->integer('course_certificate_id');
            $table->integer('certificate_criteria_id');
            $table->string('custom',255);


            $table->index('course_certificate_id');
            $table->index('certificate_criteria_id');
            $table->index('custom');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_certificate_criteria');
    }
};
