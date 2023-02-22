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
        Schema::create('notification_event', function (Blueprint $table) {
            $table->id();
            $table->string('event',255);
            $table->string('system_name',64);
            $table->string('auth',64)->nullable()->default(null);
            $table->integer('type_id');
            $table->string('icon',64)->nullable()->default(null);


            $table->index('event');
            $table->index('system_name');
            $table->index('type_id');
            $table->index('icon');
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
        Schema::dropIfExists('notification_event');
    }
};
