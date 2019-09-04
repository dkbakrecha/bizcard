<?php

use Illuminate\Support\Facades\Schema;
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
            $table->string('name');
            $table->string('profile_image')->nullable();
            $table->string('email')->unique();
            $table->string('phone',10)->unique();
            $table->boolean('is_phone_verified')->nullable()->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token', 60)->unique()->nullable();
            $table->string('token', 10)->nullable();
            $table->integer('status')->default(0);
            $table->integer('user_type')->default(0)->comment = "0 = User, 1 = Driver, 2 = Owner, 3 = admin";
            $table->string('address')->nullable();
            $table->timestamp('last_login_date')->useCurrent();
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
        Schema::dropIfExists('users');
    }
}
