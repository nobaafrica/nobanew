<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('customerCode');
            $table->string('bank')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('accountName')->nullable();
            $table->decimal('accountBalance', 10 ,2)->default(0)->nullable();
            $table->decimal('withdrawableBalance', 10, 2)->default(0)->nullable();
            $table->decimal('referralBonus', 10, 2)->nullable();
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
        Schema::dropIfExists('wallets');
    }
}
