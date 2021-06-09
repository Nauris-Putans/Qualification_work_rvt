<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_request_status', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id');
            $table->string('status_name');

            $table->primary(['status_id']);
        });

        Schema::create('user_group_request', function (Blueprint $table) {
            $table->id('requestID');
            $table->unsignedBigInteger('recipient');
            $table->unsignedBigInteger('requestor');
            $table->string('group');
            $table->unsignedBigInteger('status');
            $table->timestamp('created_at')->nullable();

            $table->foreign('recipient')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('requestor')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group')->references('group_id')->on('monitoring_users_groups')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status')->references('status_id')->on('group_request_status')
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
        Schema::dropIfExists('user_group');
    }
}
