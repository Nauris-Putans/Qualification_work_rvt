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

        Schema::create('monitoring_user_dashboard_item_types', function (Blueprint $table) {
            $table->id('item_type_id')->autoIncrement();
            $table->string('item_type_name');
        });

        Schema::create('monitoring_user_dashboard_items_colors', function (Blueprint $table) {
            $table->string('color_id');
            $table->string('header_background_color')->nullable();
            $table->string('header_text_color')->nullable();
            $table->string('chart1_background_color')->nullable();
            $table->string('chart1_border_color')->nullable();

            $table->primary('color_id');
        });

        Schema::create('monitoring_user_dashboard_items', function (Blueprint $table) {
            $table->id('item_id')->autoIncrement();
            $table->unsignedBigInteger('item')->nullable();
            $table->string('dashboardItemColor');
            $table->unsignedBigInteger('itemType');
            $table->unsignedBigInteger('user');
            $table->string('group');
            $table->unsignedBigInteger('hystory_from_days');
            $table->unsignedBigInteger('element_position');

            $table->foreign('item')->references('item_id')->on('monitoring_items')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('dashboardItemColor')->references('color_id')->on('monitoring_user_dashboard_items_colors')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('itemType')->references('item_type_id')->on('monitoring_user_dashboard_item_types')
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
