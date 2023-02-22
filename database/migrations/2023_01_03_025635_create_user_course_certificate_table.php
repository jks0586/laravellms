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

        Schema::create('user_course_certificate', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->default('0');
            $table->integer('course_certificate_id')->default('0');
            $table->integer('user_course_id')->default('0');
            $table->dateTime('last_download_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('verification_code')->nullable()->default(null);

            $table->index('user_id');
            $table->index('course_certificate_id');
            $table->index('user_course_id');
            $table->index('verification_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_course_certificate');
    }
};
