<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringZabbixActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_zabbix_actions', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_action_id');
            $table->unsignedBigInteger("zabbix_trigger");

            $table->primary("zabbix_action_id");

            $table->foreign('zabbix_trigger')->references('zabbix_triger_id')->on('monitoring_zabbix_triggers')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('monitoring_zabbix_actions_has_users', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_action');
            $table->unsignedBigInteger("user");

            $table->primary(["zabbix_action","user"]);

            $table->foreign('zabbix_action')->references('zabbix_action_id')->on('monitoring_zabbix_actions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user')->references('zabbix_user_id')->on('monitoring_zabbix_users')
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
        Schema::dropIfExists('monitoring_zabbix_actions');
    }
}
