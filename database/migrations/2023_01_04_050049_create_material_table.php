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
        Schema::create('material', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('order')->nullable()->default(null);
            $table->tinyInteger('assessment')->nullable()->default(null);
            $table->tinyInteger('require_marking')->nullable()->default(null);
            $table->tinyInteger('require_signature')->nullable()->default(null);
            $table->float('pass_percent',10,2)->default(100);
            $table->tinyInteger('view_past_attempts')->nullable()->default(0);
            $table->tinyInteger('max_attempts')->nullable()->default(0);
            $table->tinyInteger('save_correct_attempts')->nullable()->default(0);
            $table->tinyInteger('verbal_option')->nullable()->default(null);
            $table->tinyInteger('id_required')->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->string('title',255);
            $table->text('body')->nullable()->default(null);
            $table->tinyInteger('modified_by')->nullable()->default(null);
            $table->tinyInteger('delay_trigger')->nullable()->default(null);
            $table->tinyInteger('delay_time')->nullable()->default(null);
            $table->string('type',255)->default('page');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('course_id');
            $table->index('order');
            $table->index('assessment');
            $table->index('require_marking');
            $table->index('require_signature');
            $table->index('pass_percent');
            $table->index('view_past_attempts');
            $table->index('max_attempts');
            $table->index('save_correct_attempts');
            $table->index('verbal_option');
            $table->index('id_required');
            $table->index('active');
            $table->index('title');
            $table->index('modified_by');
            $table->index('delay_trigger');
            $table->index('delay_time');
            $table->index('type');

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
        Schema::dropIfExists('material');
    }
};
