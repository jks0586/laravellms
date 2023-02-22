<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('user_document', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title',255);
            $table->string('type',255);
            $table->string('size',255)->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);
            $table->string('url');
            $table->tinyInteger('visible');
            $table->tinyInteger('locked');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('user_id');
            $table->index('title');
            $table->index('type');
            $table->index('size');

            $table->index('visible');
            $table->index('locked');
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
        Schema::dropIfExists('user_document');
    }
};
