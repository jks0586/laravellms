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
        Schema::create('invoice_item', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id');
            $table->string('description',255);
            $table->float('amount',10,2);
            $table->float('discounted_amount',10,2);
            $table->integer('tax_id');


            $table->index('invoice_id');
            $table->index('amount');
            $table->index('discounted_amount');
            $table->index('tax_id');
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
        Schema::dropIfExists('invoice_item');
    }
};
