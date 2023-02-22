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
        Schema::create('organisation_course', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('course_id');
            $table->float('price',10,2);
            $table->integer('tax')->nullable()->default(null);
            $table->tinyInteger('visible')->default(0);
            $table->tinyInteger('require_identification')->default(0);
            $table->text('completion_message')->nullable()->default(null);
            $table->string('image',255)->default(null);


            $table->index('organisation_id');
            $table->index('course_id');
            $table->index('price');
            $table->index('tax');
            $table->index('visible');
            $table->index('require_identification');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_course');
    }
};
