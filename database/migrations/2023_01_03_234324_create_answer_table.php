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
        Schema::create('answer', function (Blueprint $table) {
            $table->id();
             $table->integer('question_id');
             $table->text('body');
             $table->tinyInteger('correct')->nullable()->default(null);
             $table->text('marking_notes');

             $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
             $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

             $table->index('question_id');
             $table->index('correct');
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
        Schema::dropIfExists('answer');
    }
};
