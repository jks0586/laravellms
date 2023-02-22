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
        Schema::create('ad_hoc_payment_invoice', function (Blueprint $table) {
            $table->id();
            $table->integer('ad_hoc_payment_id');
            $table->integer('invoice_id');

            $table->index('ad_hoc_payment_id');
            $table->index('invoice_id');
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
        Schema::dropIfExists('ad_hoc_payment_invoice');
    }
};
