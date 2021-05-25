<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZabbixMediatypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zabbix_mediatypes', function (Blueprint $table) {
            $table->unsignedBigInteger('MediatypesID');
            $table->string('Name');
            $table->unsignedBigInteger('Language');

            $table->primary('MediatypesID');

            $table->foreign('Language')->references('LanguageID')->on('languages')
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
        Schema::dropIfExists('zabbix_mediatypes');
    }
}
