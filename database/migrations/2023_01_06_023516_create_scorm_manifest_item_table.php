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
        Schema::create('scorm_manifest_item', function (Blueprint $table) {
            $table->id();
            $table->integer('scorm_manifest_id');
            $table->string('title',255)->nullable()->default(null);
            $table->string('identifier',255)->nullable()->default(null);
            $table->string('identifierref',255)->nullable()->default(null);
            $table->tinyInteger('isvisible')->nullable()->default(null);
            $table->text('datafromlms')->nullable()->default(null);
            $table->text('parameters')->nullable()->default(null);
            $table->binary('xml')->nullable()->default(null);
            $table->integer('root')->nullable()->default(null);
            $table->integer('level')->nullable()->default(null);
            $table->integer('lft')->nullable()->default(null);
            $table->integer('rgt')->nullable()->default(null);


            $table->index('scorm_manifest_id');
            $table->index('title');
            $table->index('identifier');
            $table->index('identifierref');
            $table->index('isvisible');
            $table->index('root');
            $table->index('level');
            $table->index('lft');
            $table->index('rgt');
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
        Schema::dropIfExists('scorm_manifest_item');
    }
};
