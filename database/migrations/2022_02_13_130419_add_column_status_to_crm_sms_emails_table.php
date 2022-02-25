<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusToCrmSmsEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crm_sms_emails', function (Blueprint $table) {
            $table->string('status')->after('content')->nullable();
            $table->string('sid')->after('status')->nullable();
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
            $table->dropColumn('status');
            $table->dropColumn('sid');
        });
    }
}
