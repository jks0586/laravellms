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
        Schema::create('course_certificate', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('course_id');
            $table->integer('certificate_id');

            $table->index('organisation_id');
            $table->index('course_id');
            $table->index('certificate_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_certificate');
    }
};
