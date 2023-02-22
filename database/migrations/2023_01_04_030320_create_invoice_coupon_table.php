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
        Schema::create('invoice_coupon', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->integer('coupon_id');
            $table->float('discount_amount',10,2)->default(0);

            $table->index('invoice_id');
            $table->index('coupon_id');
            $table->index('discount_amount');

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
        Schema::dropIfExists('invoice_coupon');
    }
};
