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
        Schema::create('user_widget', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('widget_id');
            $table->tinyInteger('visible')->default(1);
            $table->integer('sort_order')->nullable()->default(null);


            $table->index('user_id');
            $table->index('widget_id');
            $table->index('visible');
            $table->index('sort_order');
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
        Schema::dropIfExists('user_widget');
    }
};
