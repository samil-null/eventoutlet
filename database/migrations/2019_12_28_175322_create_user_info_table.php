<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('email', 255)->nullable();
            $table->string('site', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('vk', 255)->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('about_me', 1000)->nullable();
            $table->string('phone', 255)->nullable();
            $table->integer('speciality_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->bigInteger('views')->default(0);
            $table->integer('gender')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
