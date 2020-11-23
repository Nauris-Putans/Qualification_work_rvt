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
            $table->string("name");
            
            $table->timestamps();

        });
        Schema::create('monitoring_applications', function (Blueprint $table) {
            $table->unsignedBigInteger('application_id');
            $table->string("aplication_name");
            $table->timestamps();

            $table->primary("application_id");
        });
        Schema::create('monitoring_items', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->string("item_name");
            $table->timestamps();

            $table->primary("item_id");
        });
        Schema::create('monitoring_hosts_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('hosts_groups_id');
            $table->string("hosts_groups_name");
            $table->timestamps();

            $table->primary("hosts_groups_id");
        });
        Schema::create('monitoring_hosts', function (Blueprint $table) {
            $table->unsignedBigInteger('host_id');
            $table->string("host_name");
            $table->timestamps();

            $table->primary("host_id");
        });
        Schema::create('monitoring_monitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_type');
            $table->unsignedBigInteger('application');
            $table->unsignedBigInteger('item');
            $table->unsignedBigInteger('host_group');
            $table->unsignedBigInteger('host');
            $table->unsignedBigInteger('user');
            $table->timestamps();

            $table->foreign('check_type')->references('id')->on('monitoring_check_types')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('application')->references('application_id')->on('monitoring_applications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item')->references('item_id')->on('monitoring_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('host_group')->references('hosts_groups_id')->on('monitoring_hosts_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('host')->references('host_id')->on('monitoring_hosts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('roles')
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
