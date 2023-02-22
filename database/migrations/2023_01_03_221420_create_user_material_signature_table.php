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
        Schema::create('user_material_signature', function (Blueprint $table) {
            $table->id();
            $table->integer('user_material_id');
            $table->integer('user_id');
            $table->binary('signature');
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('user_material_id');
            $table->index('user_id');
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
        Schema::dropIfExists('user_material_signature');
    }
};
