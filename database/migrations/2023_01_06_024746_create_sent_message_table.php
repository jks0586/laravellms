<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('sent_message', function (Blueprint $table) {
            $table->id();
            $table->integer('message_id');
            $table->string('message_type');
            $table->string('name')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('message_id');
            $table->index('message_type');
            $table->index('name');
            $table->index('email');
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
        Schema::dropIfExists('sent_message');
    }
};
