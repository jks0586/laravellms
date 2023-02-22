<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PhpOption\None;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_avetmiss', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('current_australian_residency');
            $table->integer('citizenship_status');
            $table->integer('funding_source')->default(0);
            $table->string('gender');
            $table->string('address_property_name',255)->nullable()->default(null);
            $table->string('address_unit_number',255)->nullable()->default(null);
            $table->string('address_street_number',255)->nullable()->default(null);
            $table->string('address_street_name',255)->nullable()->default(null);
            $table->string('address_suburb',255)->nullable()->default(null);
            $table->string('address_state',255)->nullable()->default(null);
            $table->string('address_postcode',255)->nullable()->default(null);
            $table->string('lote')->nullable()->default(null);
            $table->string('language',255)->nullable()->default(null);
            $table->string('still_at_school',255)->nullable()->default(null);
            $table->string('highest_school_level',255)->nullable()->default(null);
            $table->string('prior_educational_achievement_flag',255)->nullable()->default(null);
            $table->string('prior_educational_achievement_identifier',255)->nullable()->default(null);
            $table->integer('indigenous_status')->nullable();
            $table->string('disability')->nullable()->default(null);
            $table->string('disability_types',255)->nullable()->default(null);
            $table->string('current_employment')->nullable()->default(null);
            $table->string('study_reason')->nullable()->default(null);
            $table->string('student_outcomes_survey',255)->nullable()->default(null);

            $table->index('user_id');
            $table->index('current_australian_residency');
            $table->index('citizenship_status');
            $table->index('funding_source');
            $table->index('gender');
            $table->index('address_property_name');
            $table->index('address_unit_number');
            $table->index('address_street_number');
            $table->index('address_street_name');
            $table->index('address_suburb');
            $table->index('address_state');
            $table->index('address_postcode');
            $table->index('lote');
            $table->index('language');
            $table->index('still_at_school');
            $table->index('highest_school_level');
            $table->index('prior_educational_achievement_flag');
            $table->index('prior_educational_achievement_identifier');
            $table->index('indigenous_status');
            $table->index('disability');
            $table->index('disability_types');
            $table->index('current_employment');
            $table->index('study_reason');
            $table->index('student_outcomes_survey');
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
        Schema::dropIfExists('user_avetmiss');
    }
};
