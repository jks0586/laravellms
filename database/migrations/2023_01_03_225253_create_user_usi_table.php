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
        Schema::create('user_usi', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id')->default(1);
            $table->integer('user_id');
            $table->string('usi',255);
            $table->string('first_name',255);
            $table->string('family_name',255);
            $table->date('date_of_birth');
            $table->string('status');
            $table->text('feedback')->nullable()->default(null);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('user_id');
            $table->index('usi');
            $table->index('first_name');
            $table->index('family_name');
            $table->index('status');
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
        Schema::dropIfExists('user_usi');
    }
};
