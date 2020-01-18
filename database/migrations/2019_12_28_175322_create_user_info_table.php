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
            $table->string('email', 255)->nullable()->default(null);
            $table->string('site', 255)->nullable()->default(null);
            $table->string('instagram', 255)->nullable()->default(null);
            $table->string('vk', 255)->nullable()->default(null);
            $table->string('whatsapp')->nullable()->default(null);
            $table->string('about_me', 1000)->nullable()->default(null);
            $table->string('phone', 255)->nullable()->default(null);
            $table->bigInteger('speciality_id')->nullable()->default(null);
            $table->bigInteger('city_id')->nullable()->default(null);
            $table->bigInteger('views')->default(0);
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
