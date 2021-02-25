<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringZabbixTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_zabbix_triggers', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_triger_id');
            $table->unsignedBigInteger("host");

            $table->primary("zabbix_triger_id");

            $table->foreign('host')->references('host_id')->on('monitoring_hosts')
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
        Schema::dropIfExists('monitoring_zabbix_triggers');
    }
}
