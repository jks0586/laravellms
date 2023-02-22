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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->tinyInteger('is_scorm')->nullable()->default(NULL);
            $table->tinyInteger('is_scorm_new')->nullable()->default(NULL);
            $table->string('name');
            $table->string('full_title')->nullable()->default(NULL);
            $table->string('code')->nullable()->default(NULL);
            $table->tinyInteger('require_marking')->nullable()->default(NULL);
            $table->tinyInteger('complete_in_order')->nullable()->default(NULL);
            $table->string('url')->nullable()->default(NULL);
            $table->tinyInteger('show_outline')->nullable()->default(0);
            $table->tinyInteger('show_outline_shared')->nullable()->default(0);
            $table->text('course_outline')->nullable()->default(NULL);
            $table->string('image')->nullable()->default(NULL);
            $table->string('field_of_education_identifier',6)->nullable()->default(NULL);
            $table->tinyInteger('vet_flag')->nullable()->default(NULL);
            $table->integer('nominal_hours')->nullable()->default(NULL);
            $table->string('delivery_mode',3)->nullable()->default(NULL);
            $table->longText('short_description')->nullable()->default(NULL);
            $table->longText('description')->nullable()->default(NULL);
            $table->timestamp('created')->nullable()->default(null);;
            $table->timestamp('modified')->nullable()->default(null);
            // $table->timestamps();

            $table->index('organisation_id');
            $table->index('is_scorm');
            $table->index('is_scorm_new');
            $table->index('name');
            $table->index('full_title');
            $table->index('code');
            $table->index('require_marking');
            $table->index('complete_in_order');
            $table->index('url');
            $table->index('show_outline');
            $table->index('show_outline_shared');
            $table->index('image');
            $table->index('field_of_education_identifier');
            $table->index('vet_flag');
            $table->index('nominal_hours');
            $table->index('delivery_mode');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course');
    }
};
