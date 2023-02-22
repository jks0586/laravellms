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
        Schema::create('bsservice_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('serviceId');
            $table->integer('allow_times')->default(1);
            $table->integer('allow_times_min')->default(1);
            $table->integer('interval')->default(60);
            $table->double('spot_price')->default(0);
            $table->tinyInteger('spot_invoice')->default(0);
            $table->tinyInteger('startDay')->default(0);
            $table->string('spaces_available')->default(1)->comment('spaces available per each REGULAR timed slot');
            $table->tinyInteger('show_spaces_left')->default(0)->comment('1-show,0-not show');
            $table->tinyInteger('show_multiple_spaces')->default(0)->comment('1-show,0-not show');
            $table->tinyInteger('use_popup')->default(0)->comment('1-show,0-not show');
            $table->integer('time_before')->default(0);

            $table->index('serviceId');
            $table->index('allow_times');
            $table->index('allow_times_min');
            $table->index('interval');
            $table->index('spot_price');
            $table->index('spot_invoice');
            $table->index('startDay');
            $table->index('spaces_available');
            $table->index('show_spaces_left');
            $table->index('show_multiple_spaces');
            $table->index('use_popup');
            $table->index('time_before');
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
        Schema::dropIfExists('bsservice_settings');
    }
};
