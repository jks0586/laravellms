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
        Schema::create('discussion_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('discussion_id');
            $table->integer('user_id');
            $table->string('comment',255);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('course_id');
            $table->index('discussion_id');
            $table->index('user_id');
            $table->index('comment');
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
        Schema::dropIfExists('discussion_comments');
    }
};
