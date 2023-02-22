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
        Schema::create('scorm_manifest_resource', function (Blueprint $table) {
            $table->id();
            $table->integer('scorm_manifest_id');
            $table->string('identifier',255);
            $table->string('type',255);
            $table->string('adlcp_scormtype',255);
            $table->string('href',255);
            $table->string('xml_base',255);
            $table->binary('xml');

            $table->index('scorm_manifest_id');
            $table->index('identifier');
            $table->index('type');
            $table->index('adlcp_scormtype');
            $table->index('href');
            $table->index('xml_base');

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
        Schema::dropIfExists('scorm_manifest_resource');
    }
};
