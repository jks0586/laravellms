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
        Schema::create('survey_data', function (Blueprint $table) {
            $table->id();
            $table->integer('survey_id');
            $table->integer('user_id');
            $table->integer('user_course_id')->nullable()->default(null);
            $table->text('data')->nullable()->default(null);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('survey_id');
            $table->index('user_id');
            $table->index('user_course_id');

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
        Schema::dropIfExists('survey_data');
    }
};
