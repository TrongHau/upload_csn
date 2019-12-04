<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void->nullable()
     */
    public function up()
    {
        Schema::create('csn_users', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_active', 1);
            $table->string('email')->unique();
            $table->string('username',25);
            $table->string('password');
            $table->string('user_identity',255);
            $table->string('name',255);
            $table->smallInteger('user_level');
            $table->integer('user_session_time');
            $table->smallInteger('user_session_page',100);
            $table->integer('user_lastvisit');
            $table->integer('user_regdate');
            $table->mediumInteger('user_music');
            $table->mediumInteger('user_comments');
            $table->integer('user_money');
            $table->integer('user_money_upload');
            $table->integer('user_money_download');
            $table->smallInteger('user_login_tries');
            $table->integer('user_last_login_try');
            $table->tinyInteger('user_allow_viewonline');
            $table->string('user_avatar',20);
            $table->string('user_phone_number',20);
            $table->string('user_interests',255);
            $table->string('user_actkey',32);
            $table->date('birthday');
            $table->tinyInteger('user_gender',1);
            $table->string('user_favourite',1000);
            $table->string('app',20);
            $table->string('app_id',100);
            $table->rememberToken();
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
        Schema::dropIfExists('csn_users');
    }
}
