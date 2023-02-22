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
        Schema::create('user_connect', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('first_name',255)->nullable()->default(null);
            $table->string('middle_name',255)->nullable()->default(null);
            $table->string('last_name',255)->nullable()->default(null);
            $table->string('email',255);
            $table->string('phone',150)->nullable()->default(null);
            $table->string('address',255)->nullable()->default(null);
            $table->string('suburb',255)->nullable()->default(null);
            $table->string('state',255)->nullable()->default(null);
            $table->string('postcode',255)->nullable()->default(null);
            $table->string('longitude',255)->nullable()->default(null);
            $table->string('latitude',255)->nullable()->default(null);
            $table->string('distance',10)->nullable()->default(0);
            $table->text('other_qualification')->nullable()->default(null);
            $table->integer('export_status')->default(0);
            $table->integer('short_list')->default(0);


            $table->index('user_id');
            $table->index('first_name');
            $table->index('middle_name');
            $table->index('last_name');
            $table->index('email');
            $table->index('phone');
            $table->index('address');
            $table->index('suburb');
            $table->index('state');
            $table->index('postcode');
            $table->index('longitude');
            $table->index('latitude');
            $table->index('distance');
            $table->index('export_status');
            $table->index('short_list');

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
        Schema::dropIfExists('user_connect');
    }
};
