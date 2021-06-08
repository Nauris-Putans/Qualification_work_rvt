<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('ActionID');
            $table->unsignedBigInteger('MediaTypeID');

            $table->primary(['ActionID', 'MediaTypeID']);

            $table->foreign('ActionID')->references('zabbix_action_id')->on('monitoring_zabbix_actions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('MediaTypeID')->references('MediatypesID')->on('zabbix_mediatypes')
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
        Schema::dropIfExists('monitoring_alert');
    }
}
