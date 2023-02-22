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
        Schema::create('msg', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('phone',255)->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('send_status')->default(0);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('phone');
            $table->index('status');
            $table->index('send_status');


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
        Schema::dropIfExists('msg');
    }
};
