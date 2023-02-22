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
        Schema::create('connect_invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->integer('user_id');
            $table->integer('payment_method_id');
            $table->string('reference_number')->nullable()->default(null);
            $table->integer('status');
            $table->decimal('total',10,2)->default(0);
            $table->text('session')->nullable()->default(null);
            $table->float('bulk_discount',10,2)->nullable()->default(null);
            $table->integer('user_course_id')->default(0);
            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));


            $table->index('organisation_id');
            $table->index('user_id');
            $table->index('payment_method_id');
            $table->index('reference_number');
            $table->index('status');
            $table->index('total');
            $table->index('bulk_discount');
            $table->index('user_course_id');

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
        Schema::dropIfExists('connect_invoice');
    }
};
