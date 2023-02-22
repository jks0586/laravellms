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
        Schema::create('discussion', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('order')->nullable()->defaul(null);
            $table->string('title',255);
            $table->text('body',255);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('course_id');
            $table->index('order');
            $table->index('title');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussion');
    }
};
