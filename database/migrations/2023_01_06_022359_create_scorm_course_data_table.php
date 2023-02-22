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
        Schema::create('scorm_course_data', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string('scorm_version',12);
            $table->string('cmi',255);
            $table->text('value');

            $table->index('course_id');
            $table->index('scorm_version');
            $table->index('cmi');


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
        Schema::dropIfExists('scorm_course_data');
    }
};
