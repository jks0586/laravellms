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
        Schema::create('shared_training_qualification', function (Blueprint $table) {
            $table->id();
            $table->integer('shared_training_id');
            $table->integer('qualification_id');

            $table->index('shared_training_id');
            $table->index('qualification_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shared_training_qualification');
    }
};
