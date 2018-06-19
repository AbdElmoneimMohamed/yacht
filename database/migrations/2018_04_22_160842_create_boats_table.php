<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("boatId")->nullable();
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("brand")->nullable();
            $table->string("totalRpm")->nullable();
            $table->string("tankSize")->nullable();
            $table->string("fuelQuentity")->nullable();
            $table->string("sizeByFeet")->nullable();
            $table->date("registerationDate")->nullable();
            $table->time("registerationTime")->nullable();
            $table->string("numberOfGenerators")->nullable();
            $table->string("numberOfPersons")->nullable();
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
        Schema::dropIfExists('boats');
    }
}
