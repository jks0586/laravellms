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
        Schema::create('referral', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('referrer_id');
            $table->integer('invoice_id')->nullable()->default(null);
            $table->integer('claimed')->nullable()->default(null);
            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('organisation_id');
            $table->index('user_id');
            $table->index('referrer_id');
            $table->index('invoice_id');
            $table->index('claimed');
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
        Schema::dropIfExists('referral');
    }
};
