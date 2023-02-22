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
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name',255);
            $table->tinyInteger('visible')->nullable()->default(null);
            $table->integer('weight');
            $table->longText('short_description');
            $table->longText('description');
            $table->timestamp('created')->nullable()->default(null);
            $table->timestamp('modified')->nullable()->default(null);

            $table->index('organisation_id');
            $table->index('name');
            $table->index('visible');
            $table->index('weight');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package');
    }
};
