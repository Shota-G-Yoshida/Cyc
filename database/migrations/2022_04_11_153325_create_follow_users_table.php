<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_users', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('followed_user_id')->unsigned();
            $table->integer('following_user_id')->unsigned();
            $table->timestamps();
            
            $table->foreign('followed_user_id')->references('id')->on('users')->cascadeondelete();
            $table->foreign('following_user_id')->references('id')->on('users')->cascadeondelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('follow_users');
    }
}
