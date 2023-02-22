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
        Schema::create('user_extra_field', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->string('name',255);
            $table->integer('extra_field_type');
            $table->tinyInteger('required');
            $table->tinyInteger('active');

            $table->index('organisation_id');
            $table->index('name');
            $table->index('extra_field_type');
            $table->index('required');
            $table->index('active');

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
        Schema::dropIfExists('user_extra_field');
    }
};
