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
        Schema::create('qualification_course', function (Blueprint $table) {
            $table->id();
            $table->integer('qualification_id');
            $table->integer('qualification_unit_group_id')->nullable()->default(null);
            $table->integer('course_id');
            $table->string('time_to_complete',255)->nullable()->default(null);
            $table->tinyInteger('locked')->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->tinyInteger('visible')->nullable()->default(null);

            $table->index('qualification_id');
            $table->index('qualification_unit_group_id');
            $table->index('course_id');
            $table->index('time_to_complete');
            $table->index('locked');
            $table->index('order');
            $table->index('visible');

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
        Schema::dropIfExists('qualification_course');
    }
};
