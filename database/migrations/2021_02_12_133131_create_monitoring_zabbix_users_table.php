<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringZabbixUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_zabbix_users', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_user_id');
            $table->unsignedBigInteger("user_id");
            $table->string("alert-period");

            $table->primary("zabbix_user_id");

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monitoring_zabbix_users');
    }
}
