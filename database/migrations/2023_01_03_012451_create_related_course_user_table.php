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
        Schema::create('related_course_user', function (Blueprint $table) {
            $table->id();

            $table->integer('related_course_id');
            $table->integer('user_course_id');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('related_course_id');
            $table->index('user_course_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_course_user');
    }
};
