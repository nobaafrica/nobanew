<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsOnWithdrawalPackagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->integer('period')->after('duration')->default(1);
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->foreignUuid('authorized_by')->change();
        });

        Schema::table('partnerships', function (Blueprint $table) {
            $table->integer('no_of_matured_payout')->after('percentageProfit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('period');
        });

        Schema::table('withdrawals', function (Blueprint $table) {
            $table->foreignId('authorized_by')->change();
        });

        Schema::table('partnerships', function (Blueprint $table) {
            $table->dropColumn('no_of_matured_payout');
        });
    }
}
