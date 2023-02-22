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
        Schema::create('certificate', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name');
            $table->string('image')->nullable()->default(null);
            $table->text('data')->nullable()->default(null);
            $table->text('gui')->nullable()->default(null);
            $table->timestamps();

            $table->index('organisation_id');
            $table->index('name');
            $table->index('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificate');
    }
};
