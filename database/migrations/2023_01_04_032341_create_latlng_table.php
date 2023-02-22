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
        Schema::create('latlng', function (Blueprint $table) {
            $table->id();
            $table->string('postcode',255);
            $table->string('state',255);
            $table->string('lat',255);
            $table->string('lng',255);
            $table->integer('status')->default(0);

            $table->index('postcode');
            $table->index('state');
            $table->index('lat');
            $table->index('lng');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('latlng');
    }
};
