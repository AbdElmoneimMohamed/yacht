<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password')->nullable();
            $table->text('imageUrl')->nullable();
            $table->string('forget_token')->nullable();
            $table->string("avatar")->nullable();
            $table->text("fb_token")->nullable();
            $table->string("address")->nullable();
            $table->string("activationCode")->nullable();
            $table->string("activated")->nullable();
            $table->string("deviceType")->nullable();
            $table->boolean("status")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
