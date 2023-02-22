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
        Schema::create('package_course', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('package_id');
            $table->integer('course_id');
            $table->string('price');

            $table->index('organisation_id');
            $table->index('package_id');
            $table->index('course_id');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_course');
    }
};
