<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('dashboard_element_type', function (Blueprint $table) {
            $table->id('item_type_id')->autoIncrement();
            $table->string('item_type_name');
        });

        Schema::create('dashboard_container', function (Blueprint $table) {
            $table->unsignedBigInteger('container_id');
            $table->string('container_name');

            $table->primary('container_id');
        });

        Schema::create('dashboard_element', function (Blueprint $table) {
            $table->string('elementId');
            $table->unsignedBigInteger('itemType');
            $table->unsignedBigInteger('user');
            $table->string('group');
            $table->unsignedBigInteger('element_position');
            $table->unsignedBigInteger('container');
            $table->string('name')->nullable();

            $table->primary('elementId');

            $table->foreign('user')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('itemType')->references('item_type_id')->on('dashboard_element_type')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('container')->references('container_id')->on('dashboard_container')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('dashboard_element_style', function (Blueprint $table) {
            $table->id('style_id')->autoIncrement();
            $table->string('element');
            $table->unsignedBigInteger('item');
            $table->string('background_color')->nullable();
            $table->string('hover_background_color')->nullable();
            $table->string('border_color')->nullable();
            $table->string('border_width')->nullable();

            $table->foreign('element')->references('elementId')->on('dashboard_element')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item')->references('item_id')->on('monitoring_items')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('dashboard_chart_type', function (Blueprint $table) {
            $table->unsignedBigInteger('chartTypeId');
            $table->string('chart_type');

            $table->primary('chartTypeId');
        });

        Schema::create('measurement_unit', function (Blueprint $table) {
            $table->id('unit_id')->autoIncrement();
            $table->string('symbol');
        });

        Schema::create('dashboard_element_item', function (Blueprint $table) {
            $table->string('dashboardElement');
            $table->unsignedBigInteger('item');
            $table->unsignedBigInteger('chart_type');
            $table->unsignedBigInteger('unit');

            $table->primary(['dashboardElement','item']);

            $table->foreign('dashboardElement')->references('elementId')->on('dashboard_element')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('item')->references('item_id')->on('monitoring_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('chart_type')->references('chartTypeId')->on('dashboard_chart_type')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit')->references('unit_id')->on('measurement_unit')
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
        Schema::dropIfExists('user_dashboard');
    }
}
