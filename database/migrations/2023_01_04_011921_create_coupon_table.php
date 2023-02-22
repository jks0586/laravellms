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
        Schema::create('coupon', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->tinyInteger('enabled')->default(0);
            $table->tinyInteger('allow_multiple')->nullable()->default(0);
            $table->string('code',64);
            $table->string('description',255)->nullable()->default(null);
            $table->tinyInteger('coupon_type_id');
            $table->float('value');
            $table->integer('max_uses')->nullable()->default(null)->comment('Leave blank for unlimited uses');
            $table->date('valid_from')->nullable()->default(null)->comment('Leave blank to enable immediately');
            $table->date('valid_until')->nullable()->default(null)->comment('Leave blank to make it valid indefinitely');
            $table->text('notes')->nullable()->default(null);


            $table->index('organisation_id');
            $table->index('enabled');
            $table->index('allow_multiple');
            $table->index('code');
            $table->index('description');
            $table->index('coupon_type_id');
            $table->index('value');
            $table->index('max_uses');
            $table->index('valid_from');
            $table->index('valid_until');

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
        Schema::dropIfExists('coupon');
    }
};
