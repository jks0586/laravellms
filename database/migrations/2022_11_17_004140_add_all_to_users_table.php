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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('usi',255)->nullable()->after('id');
            $table->tinyInteger('is_admin')->default(0)->after('usi');
            $table->string('title',255)->nullable()->after('is_admin');
            $table->string('first_name',255)->nullable()->after('name');
            $table->string('middle_name',255)->nullable()->after('first_name');
            $table->string('last_name',255)->nullable()->after('middle_name');
            $table->string('name_on_invoice',255)->nullable()->after('last_name');
            $table->string('staff_id',255)->nullable()->after('email');
            $table->tinyInteger('verified_identity')->default(0)->after('staff_id');
            $table->tinyInteger('phone')->default(0)->after('verified_identity');
            $table->string('address_country',255)->nullable()->after('phone');
            $table->string('address',255)->nullable()->after('address_country');
            $table->string('suburb',255)->nullable()->after('address');
            $table->string('state',255)->nullable()->after('suburb');
            $table->string('postcode',255)->nullable()->after('state');
            $table->tinyInteger('country_of_birth')->default(0)->after('postcode');
            $table->date('date_of_birth')->nullable()->after('country_of_birth');
            $table->tinyInteger('organisation_id')->default(0)->after('password');
            $table->string('browser',255)->nullable()->after('organisation_id');
            $table->string('browser_version',255)->nullable()->after('browser');
            $table->string('ip',255)->nullable()->after('browser_version');
            $table->string('activity_stamp',255)->nullable()->after('created_at');
            $table->string('mla_type',255)->nullable()->after('activity_stamp');
            $table->string('mla_register',255)->nullable()->after('mla_type');
            $table->string('mla_feedlot',255)->nullable()->after('mla_register');
            $table->string('mla_manufacturers_company',255)->nullable()->after('mla_feedlot');
            $table->string('mla_company',255)->nullable()->after('mla_manufacturers_company');
            $table->string('mla_road_address',255)->nullable()->after('mla_company');
            $table->string('mla_town',255)->nullable()->after('mla_road_address');
            $table->string('longitude',255)->nullable()->after('mla_town');
            $table->string('latitude',255)->nullable()->after('longitude');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('usi',255);
            $table->tinyInteger('is_admin');
            $table->dropColumn('title',255);
            $table->dropColumn('first_name',255);
            $table->dropColumn('middle_name',255);
            $table->dropColumn('last_name',255);
            $table->dropColumn('name_on_invoice',255);
            $table->dropColumn('staff_id',255);
            $table->dropColumn('verified_identity');
            $table->dropColumn('phone');
            $table->dropColumn('address_country',255);
            $table->dropColumn('address',255);
            $table->dropColumn('suburb',255);
            $table->dropColumn('state',255);
            $table->dropColumn('postcode',255);
            $table->dropColumn('country_of_birth');
            $table->dropColumn('date_of_birth');
            $table->tinyInteger('organisation_id');
            $table->dropColumn('browser',255);
            $table->dropColumn('browser_version',255);
            $table->dropColumn('ip',255);
            $table->dropColumn('activity_stamp',255);
            $table->dropColumn('mla_type',255);
            $table->dropColumn('mla_register',255);
            $table->dropColumn('mla_feedlot',255);
            $table->dropColumn('mla_manufacturers_company',255);
            $table->dropColumn('mla_company',255);
            $table->dropColumn('mla_road_address',255);
            $table->dropColumn('mla_town',255);
            $table->dropColumn('longitude',255);
            $table->dropColumn('latitude',255);
        });
    }
};
