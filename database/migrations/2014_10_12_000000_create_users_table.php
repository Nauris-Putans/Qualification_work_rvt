<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile_image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->unique()->nullable();
            $table->unsignedBigInteger('country')->nullable();
            $table->string('city')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country')->references('id')->on('countries')
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
        Schema::dropIfExists('users');
    }
}
