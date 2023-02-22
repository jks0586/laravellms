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
        Schema::create('shared_training', function (Blueprint $table) {
            $table->id();
            $table->integer('trainer_id');
            $table->integer('shared_trainer_id');
            $table->tinyInteger('active')->nullable()->default(null);


            $table->index('trainer_id');
            $table->index('shared_trainer_id');
            $table->index('active');

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
        Schema::dropIfExists('shared_training');
    }
};
