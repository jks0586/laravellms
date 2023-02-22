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
        Schema::create('log', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('model_id');
            $table->integer('organisation_id');
            $table->string('model',255);
            $table->text('data');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('user_id');
            $table->index('model_id');
            $table->index('organisation_id');
            $table->index('model');
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
        Schema::dropIfExists('log');
    }
};
