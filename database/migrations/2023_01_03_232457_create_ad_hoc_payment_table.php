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
        Schema::create('ad_hoc_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('organisation_id');
            $table->tinyInteger('active')->nullable()->default(null);
            $table->string('name',255)->nullable()->default(null);
            $table->decimal('amount',10,2);
            $table->text('description')->nullable()->default(null);
            $table->text('thank_you_message')->nullable()->default(null);

            $table->dateTime('created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('modified')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index('organisation_id');
            $table->index('active');
            $table->index('name');
            $table->index('amount');
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
        Schema::dropIfExists('ad_hoc_payment');
    }
};
