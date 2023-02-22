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
        Schema::create('mailchimp_group', function (Blueprint $table) {
            $table->id();
            $table->integer('mailchimp_setting_id');
            $table->string('event',255);
            $table->text('actions');

            $table->index('mailchimp_setting_id');
            $table->index('event');
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
        Schema::dropIfExists('mailchimp_group');
    }
};
