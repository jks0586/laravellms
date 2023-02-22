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

        Schema::create('user_identification', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id')->default(1);
            $table->integer('user_id');
            $table->binary('identification');
            $table->tinyInteger('denied')->nullable()->default(null);
            $table->string('reason',255)->nullable()->default(null);;
            $table->tinyInteger('editable')->default(0);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('user_id');

            $table->index('denied');
            $table->index('reason');
            $table->index('editable');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_identification');
    }
};
