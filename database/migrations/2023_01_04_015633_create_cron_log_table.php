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
        Schema::create('cron_log', function (Blueprint $table) {
            $table->id();
            $table->string('run_time',255);
            $table->binary('data')->nullable()->default(null);;
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('run_time');


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
        Schema::dropIfExists('cron_log');
    }
};
