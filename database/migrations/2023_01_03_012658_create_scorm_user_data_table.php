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
        Schema::create('scorm_user_data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('user_course_id');
            $table->string('scorm_version',12);
            $table->integer('sco_index');
            $table->string('cmi',255);
            $table->text('value');

            $table->index('user_id');
            $table->index('user_course_id');
            $table->index('scorm_version');
            $table->index('sco_index');
            $table->index('cmi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scorm_user_data');
    }
};
