<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonitoringMonitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_check_types', function (Blueprint $table) {
            $table->id();
            $table->string("check_type_name");
        });

        Schema::create('monitoring_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('application_id');
            $table->string("application_name");

            $table->primary("application_id");
        });

        Schema::create('monitoring_monitor_type', function (Blueprint $table) {
            $table->unsignedBigInteger('monitor_type_id');
            $table->string("monitor_type");

            $table->primary("monitor_type_id");
        });

        Schema::create('monitoring_items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger("check_type");
            $table->unsignedBigInteger("application");

            $table->primary("item_id");

            $table->foreign('check_type')->references('id')->on('monitoring_check_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application')->references('application_id')->on('monitoring_applications')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('monitoring_users_groups', function (Blueprint $table) {
            $table->string('group_id');
            $table->unsignedBigInteger('group_admin_id');
            $table->string('group_name');

            $table->primary('group_id');

            $table->foreign('group_admin_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

 
        Schema::create('group_member_permission', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('permission_name');

            $table->unique('permission_name', 'permission_id');
            $table->primary(["permission_id"]);
        });

        Schema::create('monitoring_group_members', function (Blueprint $table) {
            $table->string('group_id');
            $table->unsignedBigInteger('group_member');
            $table->unsignedBigInteger('group_member_permission');

            $table->primary(["group_id","group_member"]);

            $table->foreign('group_id')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_member')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_member_permission')->references('permission_id')->on('group_member_permission')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    
        Schema::create('monitoring_hosts_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('host_group_id');
            $table->string("host_group_name");
            $table->string("user_group");

            $table->primary("host_group_id");

            $table->foreign('user_group')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('monitoring_hosts', function (Blueprint $table) {
            $table->unsignedBigInteger('host_id');
            $table->string("host_name");
            $table->string("check_address");
            $table->unsignedBigInteger("host_group");

            $table->primary("host_id");

            $table->foreign('host_group')->references('host_group_id')->on('monitoring_hosts_groups')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('monitoring_status', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id');
            $table->string("status_name");

            $table->primary("status_id");
        });

        Schema::create('monitoring_monitors', function (Blueprint $table) {
            $table->id();
            $table->string('friendly_name');
            $table->string('user_input');
            $table->string('user_group');
            $table->unsignedBigInteger("monitor_type");
            $table->string("check_interval");
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('host');
            $table->unsignedBigInteger('status');

            $table->timestamps();

            $table->foreign('user_group')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('monitor_type')->references('monitor_type_id')->on('monitoring_monitor_type')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('host')->references('host_id')->on('monitoring_hosts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status')->references('status_id')->on('monitoring_status')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('web_scenarios', function (Blueprint $table) {

            $table->unsignedBigInteger("httptest_id");
            $table->string("httptest_name");

            $table->primary("httptest_id");
        });

        Schema::create('host_has_application_webScenario', function (Blueprint $table) {

            $table->unsignedBigInteger("host_id");
            $table->unsignedBigInteger("application");
            $table->unsignedBigInteger("web_scenario")->nullable();

            $table->primary(["host_id","application"]);

            $table->foreign('host_id')->references('host_id')->on('monitoring_hosts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application')->references('application_id')->on('monitoring_applications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('web_scenario')->references('httptest_id')->on('web_scenarios')
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
        Schema::dropIfExists('monitoring_monitors');
    }
}
