<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_card', function (Blueprint $table) {
            $table->id();
            $table->integer('card_id');
            $table->integer('user_id');
            $table->integer('user_course_id');
            $table->string('card_number',255)->nullable()->default(null);
            $table->dateTime('issue_date')->nullable()->default(null);
            $table->dateTime('expires')->nullable()->default(null);
            $table->binary('signature')->nullable()->default(null);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('card_id');
            $table->index('user_id');
            $table->index('user_course_id');
            $table->index('card_number');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_card');
    }
};
