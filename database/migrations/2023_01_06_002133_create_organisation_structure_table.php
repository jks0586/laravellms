<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('organisation_structure', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id');
            $table->integer('organisation_id');
            $table->tinyInteger('active');

            $table->index('language_id');
            $table->index('organisation_id');
            $table->index('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_structure');
    }
};
