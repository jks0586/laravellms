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
        Schema::create('qualification', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name',255);
            $table->string('full_title',255);
            $table->string('code',255);
            $table->float('price',10,2);
            $table->string('time_to_complete')->nullable()->default(null);
            $table->tinyInteger('visible')->nullable()->default(null);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('organisation_id');
            $table->index('name');
            $table->index('full_title');
            $table->index('code');
            $table->index('price');
            $table->index('time_to_complete');
            $table->index('visible');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualification');
    }
};
