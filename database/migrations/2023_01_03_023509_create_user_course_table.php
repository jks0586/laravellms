<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('user_course', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('course_id')->nullable()->default(null);
            $table->integer('trainer_id')->nullable()->default(null);
            $table->integer('user_qualification_id')->nullable()->default(null);
            $table->tinyInteger('locked')->nullable()->default(null);
            $table->tinyInteger('from_referral')->nullable()->default(null);
            $table->tinyInteger('free_from_referral')->nullable()->default(null);
            $table->string('lesson_location',255)->default(null);
            $table->float('completion_percent')->default(0);
            $table->tinyInteger('complete')->default(null);
            $table->tinyInteger('completed_as_rpl')->default(null);
            $table->string('total_time',255)->default(null);
            $table->string('time_to_complete',255)->default(null);
            $table->dateTime('start_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('finish_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->tinyInteger('invoice_id')->nullable()->default(0);
            $table->tinyInteger('certificate_issue')->nullable()->default(0);
            $table->tinyInteger('un_enroll')->nullable()->default(0);

            $table->index('user_id');
            $table->index('course_id');
            $table->index('trainer_id');
            $table->index('user_qualification_id');
            $table->index('locked');
            $table->index('from_referral');
            $table->index('free_from_referral');
            $table->index('lesson_location');
            $table->index('completion_percent');
            $table->index('complete');
            $table->index('completed_as_rpl');
            $table->index('total_time');
            $table->index('time_to_complete');
            $table->index('invoice_id');

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
        Schema::dropIfExists('user_course');
    }
};
