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
        Schema::create('message', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name',255);
            $table->string('type',255);
            $table->string('subject',255);
            $table->text('body');
            $table->tinyInteger('enabled')->nullable()->default(null);
            $table->tinyInteger('send_once')->nullable()->default(null);
            $table->string('schedule',255)->nullable()->default(null);
            $table->binary('criteria',255)->nullable()->default(null);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('organisation_id');
            $table->index('name');
            $table->index('type');
            $table->index('subject');
            $table->index('enabled');
            $table->index('send_once');
            $table->index('schedule');

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
        Schema::dropIfExists('message');
    }
};
