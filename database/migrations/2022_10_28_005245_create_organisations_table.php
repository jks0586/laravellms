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
        Schema::create('organisation', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_organisation_id')->default(0);
            $table->string('name');
            $table->string('url');
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('use_organisation_structure')->default(0);
            $table->tinyInteger('use_usi')->default(0);
            $table->tinyInteger('use_staff_id')->default(0);
            $table->string('from_email')->nullable();
            $table->string('identity_verification_email')->nullable();
            $table->string('time_zone')->nullable();
            $table->dateTime('trial_end')->nullable();
            $table->string('email_template')->nullable();
            $table->string('logo')->nullable();
            $table->string('background_image')->nullable();
            $table->string('background_position')->nullable();
            $table->string('background_repeat')->nullable();
            $table->string('background_size')->nullable();
            $table->string('background_color')->nullable();
            $table->string('print_logo')->nullable();
            $table->string('footer_text')->nullable();
            $table->text('restrict_by_ip')->nullable();
            $table->integer('eway_customer_id')->nullable();
            $table->string('eway_user_name')->nullable();
            $table->string('stripe_secret_key')->nullable();
            $table->string('stripe_publishable_key')->nullable();
            $table->tinyInteger('enable_eway')->default(0);
            $table->tinyInteger('enable_stripe')->default(0);
            $table->tinyInteger('eway_test_mode')->default(0);
            $table->text('terms_and_conditions')->nullable();
            $table->text('identity_requirements')->nullable();
            $table->text('welcome_email')->nullable();
            $table->text('new_course_email')->nullable();
            $table->text('set_password_email')->nullable();
            $table->text('course_complete_email')->nullable();
            $table->text('invoice_address')->nullable();
            $table->text('invoice_thankyou_message')->nullable();
            $table->text('avetmiss_privacy_notice')->nullable();
            $table->timestamp('created')->nullable()->default(null);;
            $table->timestamp('modified')->nullable()->default(null);
            // $table->timestamps();
            $table->index('parent_organisation_id');
            $table->index('name');
            $table->index('url');
            $table->index('active');
            $table->index('use_organisation_structure');
            $table->index('use_usi');
            $table->index('use_staff_id');
            $table->index('from_email');
            $table->index('identity_verification_email');
            $table->index('time_zone');
            $table->index('trial_end');
            $table->index('email_template');
            $table->index('logo');
            $table->index('background_image');
            $table->index('background_position');
            $table->index('background_repeat');
            $table->index('background_size');
            $table->index('background_color');
            $table->index('print_logo');
            $table->index('footer_text');
            $table->index('eway_customer_id');
            $table->index('eway_user_name');
            $table->index('stripe_secret_key');
            $table->index('stripe_publishable_key');
            $table->index('enable_eway');
            $table->index('enable_stripe');
            $table->index('eway_test_mode');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation');
    }
};
