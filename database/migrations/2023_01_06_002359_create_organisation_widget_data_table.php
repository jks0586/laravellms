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
        Schema::create('organisation_widget_data', function (Blueprint $table) {
            $table->id();

            $table->integer('organisation_id');
            $table->integer('widget_id');
            $table->string('title',255);
            $table->text('data');
            $table->dateTime('modified')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('widget_id');
            $table->index('title');
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
        Schema::dropIfExists('organisation_widget_data');
    }
};
