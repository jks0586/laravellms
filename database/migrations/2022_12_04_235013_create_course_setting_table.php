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
        Schema::create('course_setting', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('course_id');
            $table->float('price',8,2);
            $table->float('wholesale_price',8,2)->nullable()->default(NULL);
            $table->integer('tax')->nullable()->default(NULL);
            $table->tinyInteger('free_with_referral')->nullable()->default(NULL);
            $table->tinyInteger('visible')->default(0);
            $table->integer('weight')->nullable()->default(NULL);
            $table->tinyInteger('downloadable_assessments')->nullable()->default(NULL);
            $table->tinyInteger('require_identification')->default(0);
            $table->tinyInteger('editable_id_verification')->nullable()->default(NULL);
            $table->string('time_to_complete',64)->nullable()->default(NULL);
            $table->tinyInteger('custom_welcome_email')->default(0);
            $table->string('welcome_email_subject')->nullable()->default(NULL);
            $table->text('welcome_email')->nullable()->default(NULL);
            $table->text('assessment_pdf_cover_page')->nullable()->default(NULL);
            $table->text('not_yet_competent_message')->nullable()->default(NULL);
            $table->text('completion_message')->nullable()->default(NULL);
            $table->string('completion_subject')->nullable()->default(NULL);
            $table->string('image')->nullable()->default(NULL);
            $table->string('course_expiry_charge')->nullable()->default(NULL);
            $table->timestamp('created')->nullable()->default(null);;
            $table->timestamp('modified')->nullable()->default(null);
            $table->index('organisation_id');
            $table->index('course_id');
            $table->index('price');
            $table->index('wholesale_price');
            $table->index('tax');
            $table->index('free_with_referral');
            $table->index('visible');
            $table->index('weight');
            $table->index('downloadable_assessments');
            $table->index('require_identification');
            $table->index('editable_id_verification');
            $table->index('time_to_complete');
            $table->index('custom_welcome_email');
            $table->index('welcome_email_subject');
            $table->index('completion_subject');
            $table->index('image');
            $table->index('course_expiry_charge');
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
        Schema::dropIfExists('course_setting');
    }
};
