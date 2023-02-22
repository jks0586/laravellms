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
        Schema::create('user_extra_field_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('extra_field_id');
            $table->text('more_info');
            $table->text('value');

            $table->index('user_id');
            $table->index('extra_field_id');

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
        Schema::dropIfExists('user_extra_field_data');
    }
};
