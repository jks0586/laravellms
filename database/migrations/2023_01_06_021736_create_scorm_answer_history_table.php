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
        Schema::create('scorm_answer_history', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_course_id');
            $table->integer('sco_index');
            $table->integer('attempt')->default(1);
            $table->integer('interaction_index');
            $table->string('interaction_id',255);
            $table->string('type',255);
            $table->string('status',255);
            $table->text('response')->nullable();

            $table->index('user_id');
            $table->index('user_course_id');
            $table->index('sco_index');
            $table->index('attempt');
            $table->index('interaction_index');
            $table->index('interaction_id');
            $table->index('type');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scorm_answer_history');
    }
};
