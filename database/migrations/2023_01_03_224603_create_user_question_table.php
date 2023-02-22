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

        Schema::create('user_question', function (Blueprint $table) {
            $table->id();
            $table->integer('user_material_id');
            $table->integer('question_id');
            $table->integer('attempt');
            $table->tinyInteger('correct')->nullable()->default(null);
            $table->text('feedback')->nullable()->default(null);
            $table->integer('sub_attempt')->nullable()->default(null);
            $table->integer('rand_attempt')->default(0);

            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('user_material_id');
            $table->index('question_id');
            $table->index('attempt');
            $table->index('correct');

            $table->index('sub_attempt');
            $table->index('rand_attempt');
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
        Schema::dropIfExists('user_question');
    }
};
