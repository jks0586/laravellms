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
        Schema::create('user_extra_field_option', function (Blueprint $table) {
            $table->id();
            $table->integer('extra_field_id');
            $table->string('option',255);
            $table->tinyInteger('active');
            $table->tinyInteger('prevent_submit');
            $table->tinyInteger('require_more_info');
            $table->text('description');


            $table->index('extra_field_id');
            $table->index('option');
            $table->index('active');
            $table->index('prevent_submit');
            $table->index('require_more_info');
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
        Schema::dropIfExists('user_extra_field_option');
    }
};
