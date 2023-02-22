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
        Schema::create('bsservices', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->date('date_created');
            $table->enum('type',['t','d'])->default('t');
            $table->tinyInteger('autoconfirm')->default(0);
            $table->string('fromName',255)->default('Name');
            $table->string('fromEmail',255)->default('noreply@email.com');
            $table->tinyInteger('show_event_titles')->default(0);
            $table->tinyInteger('show_event_image')->default(0);
            $table->tinyInteger('show_available_seats')->default(0);
            $table->enum('default',['y','n'])->default('n');
            $table->decimal('deposit',10,2)->default('1.00');
            $table->enum('delBookings',['y','n'])->default('n');

            $table->index('name');
            $table->index('date_created');
            $table->index('type');
            $table->index('autoconfirm');
            $table->index('fromName');
            $table->index('fromEmail');
            $table->index('show_event_titles');
            $table->index('show_event_image');
            $table->index('show_available_seats');
            $table->index('default');
            $table->index('deposit');
            $table->index('delBookings');
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
        Schema::dropIfExists('bsservices');
    }
};
