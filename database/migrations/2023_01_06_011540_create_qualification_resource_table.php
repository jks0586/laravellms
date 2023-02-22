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
        Schema::create('qualification_resource', function (Blueprint $table) {
            $table->id();
            $table->integer('resource_id');
            $table->integer('qualification_id');
            $table->tinyInteger('visible')->nullable()->default(1);

            $table->index('resource_id');
            $table->index('qualification_id');
            $table->index('visible');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualification_resource');
    }
};
