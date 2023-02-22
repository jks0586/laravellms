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
        Schema::create('page_history', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string('identifier',255);
            $table->text('html');
            $table->dateTime('date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('course_id');
            $table->index('identifier');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_history');
    }
};
