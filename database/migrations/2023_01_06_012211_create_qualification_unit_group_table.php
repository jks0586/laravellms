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
        Schema::create('qualification_unit_group', function (Blueprint $table) {
            $table->id();
            $table->integer('qualification_id');
            $table->string('name',255);
            $table->tinyInteger('electives')->nullable()->default(null);
            $table->integer('number_to_choose')->default(1);

            $table->dateTime('created')->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('qualification_id');
            $table->index('name');
            $table->index('electives');
            $table->index('number_to_choose');


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
        Schema::dropIfExists('qualification_unit_group');
    }
};
