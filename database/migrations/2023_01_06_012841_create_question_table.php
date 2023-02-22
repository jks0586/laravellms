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
        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->integer('material_id');
            $table->integer('version_root')->nullable()->default(null);
            $table->tinyInteger('active')->nullable()->default(null);
            $table->tinyInteger('visible')->nullable()->default(1);
            $table->tinyInteger('optional')->nullable()->default(null);
            $table->integer('order')->nullable()->default(null);
            $table->text('body');
            $table->text('marking_notes')->nullable();
            $table->tinyInteger('mark_manually')->nullable()->default(null);
            $table->tinyInteger('shuffle_answers')->nullable()->default(1);
            $table->integer('answer_type');
            $table->integer('reference_material')->nullable()->default(1);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('parent')->default(0);

            $table->index('material_id');
            $table->index('version_root');
            $table->index('active');
            $table->index('visible');
            $table->index('optional');
            $table->index('order');
            $table->index('mark_manually');
            $table->index('shuffle_answers');
            $table->index('answer_type');
            $table->index('reference_material');
            $table->index('parent');

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
        Schema::dropIfExists('question');
    }
};
