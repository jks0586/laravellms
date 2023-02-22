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
        Schema::create('mailchimp_setting', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('course_id')->nullable()->default(null);
            $table->integer('qualification_id')->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->string('mailchimp_api_key');
            $table->string('mailchimp_list_id');
            $table->string('mailchimp_category_id');

            $table->index('organisation_id');
            $table->index('course_id');
            $table->index('qualification_id');
            $table->index('active');
            $table->index('mailchimp_api_key');
            $table->index('mailchimp_list_id');
            $table->index('mailchimp_category_id');
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
        Schema::dropIfExists('mailchimp_setting');
    }
};
