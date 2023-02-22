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
        Schema::create('edit_discussion_history', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('model',255);
            $table->integer('model_key');
            $table->text('backup');
            $table->integer('modified_by');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('organisation_id');
            $table->index('model');
            $table->index('model_key');
            $table->index('modified_by');
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
        Schema::dropIfExists('edit_discussion_history');
    }
};
