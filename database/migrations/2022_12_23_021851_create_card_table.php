<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PhpOption\None;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('card', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id')->default(null);
            $table->string('name');
            $table->string('valid_for')->nullable()->default(null);
            $table->tinyInteger('auto_generate_card_number')->nullable()->default(null);
            $table->integer('starting_card_number')->nullable()->default(null);
            $table->tinyInteger('send_email_on_issue')->nullable()->default(null);
            $table->text('email_message')->nullable()->default(null);
            $table->timestamp('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('name');
            $table->index('valid_for');
            $table->index('auto_generate_card_number');
            $table->index('starting_card_number');
            $table->index('send_email_on_issue');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
};
