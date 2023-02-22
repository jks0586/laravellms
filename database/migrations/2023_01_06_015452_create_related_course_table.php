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
        Schema::create('related_course', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('course_id');
            $table->integer('course_setting_id');
            $table->decimal('price',10,2);
            $table->integer('tax_id')->nullable()->default(null);
            $table->integer('weight')->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(0);

            $table->index('organisation_id');
            $table->index('course_id');
            $table->index('course_setting_id');
            $table->index('price');
            $table->index('tax_id');
            $table->index('weight');

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
        Schema::dropIfExists('related_course');
    }
};
