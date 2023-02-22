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
        Schema::create('user_business', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('abn',255);
            $table->string('name',255);
            $table->string('phone',255);
            $table->string('email',255)->nullable()->default(null);
            $table->integer('status')->default(0);
            $table->string('address',255)->nullable()->default(null);



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
        Schema::dropIfExists('user_business');
    }
};
