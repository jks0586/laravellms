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
        Schema::create('scorm_curriculum', function (Blueprint $table) {
            $table->id();

            $table->string('scorm_provider',255);
            $table->string('identifier',255);
            $table->integer('course_id');
            $table->dateTime('date_added')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('scorm_provider');
            $table->index('identifier');
            $table->index('course_id');
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
        Schema::dropIfExists('scorm_curriculum');
    }
};
