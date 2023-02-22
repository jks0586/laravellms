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
        Schema::create('resource', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('title',255);
            $table->string('type',255);
            $table->string('size',64);
            $table->string('url',255);
            $table->tinyInteger('assessment')->nullable()->default(0);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('title');
            $table->index('type');
            $table->index('size');
            $table->index('url');
            $table->index('assessment');
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
        Schema::dropIfExists('resource');
    }
};
