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

        Schema::create('user_qualification', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('qualification_id');
            $table->integer('trainer_id')->nullable()->default(0);;
            $table->tinyInteger('status')->nullable()->default(0);
            $table->tinyInteger('secondary_status')->nullable()->default(0);
            $table->tinyInteger('complete')->nullable()->default(0);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('expiry_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('completed_date')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('user_qualification');
    }
};
