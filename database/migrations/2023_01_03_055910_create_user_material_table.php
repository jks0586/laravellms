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
        Schema::create('user_material', function (Blueprint $table) {
            $table->id();
            $table->integer('user_course_id');
            $table->integer('user_id');
            $table->integer('material_id');
            $table->integer('attempt');
            $table->tinyInteger('another_attempt')->nullable()->default(0);
            $table->tinyInteger('complete')->nullable()->default(null);
            $table->float('percent')->nullable()->default(0);
            $table->string('time')->nullable()->default(null);
            $table->string('marking_time')->nullable()->default(null);
            $table->tinyInteger('marked_by')->nullable()->default(null);
            $table->text('feedback')->nullable()->default(null);
            $table->string('submitted_date')->nullable()->default(null);
            $table->dateTime('marking_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('user_course_id');
            $table->index('user_id');
            $table->index('material_id');
            $table->index('attempt');
            $table->index('another_attempt');
            $table->index('complete');
            $table->index('marked_by');
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
        Schema::dropIfExists('user_material');
    }
};
