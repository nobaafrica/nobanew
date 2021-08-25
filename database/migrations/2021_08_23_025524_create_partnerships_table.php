<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('package_id');
            $table->string('package_name');
            $table->decimal('amount', 10, 2);
            $table->boolean('isRedeemed')->default(0)->nullable();
            $table->decimal('estimatedPayout', 10, 2)->nullable();
            $table->integer('commodityUnit')->nullable();
            $table->integer('percentageProfit')->nullable();
            $table->timestamp('payoutDate')->nullable();
            $table->decimal('estimatedProfit', 10, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partnerships');
    }
}
