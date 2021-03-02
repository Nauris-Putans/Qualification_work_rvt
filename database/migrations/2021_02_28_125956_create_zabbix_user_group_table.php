<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZabbixUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zabbix_user_group', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_group_id');
            $table->string('zabbix_group_name');
            $table->unsignedBigInteger('zabbix_group_admin');

            $table->primary('zabbix_group_id');

            $table->foreign('zabbix_group_admin')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        
        Schema::create('zabbix_group_members', function (Blueprint $table) {
            $table->unsignedBigInteger('zabbix_group_id');
            $table->unsignedBigInteger('zabbix_group_member');

            $table->primary(['zabbix_group_id','zabbix_group_member']);

            $table->foreign('zabbix_group_member')->references('zabbix_user_id')->on('monitoring_zabbix_users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('zabbix_group_id')->references('zabbix_group_id')->on('zabbix_user_group')
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
        Schema::dropIfExists('zabbix_user_group');
    }
}
