<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUpdateColumnStatusAndSidCrmSmsEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_sms_emails', function (Blueprint $table) {
            $table->string('status')->nullable(false)->change();
            $table->string('sid')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crm_sms_emails', function (Blueprint $table) {
            $table->string('status')->nullable();
            $table->string('sid')->nullable();
        });
    }
}
