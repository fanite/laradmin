<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('staff_code', 100)->unique()->comment('工号');
            $table->string('name')->comment('名字');
            $table->string('email')->unique();
            $table->integer('phone')->comment('电话号码');
            $table->enum('gender', ['male', 'female'])->nullable()->comment('性别');
            $table->string('work_place', 100)->comment('工作地点');
            $table->text('avatar')->comment('头像地址');
            $table->string('password');
            $table->ipAddress('last_ip')->comment('最后登录的IP地址');
            $table->boolean('is_admin')->comment('超级账户');
            $table->string('user_type', 100)->nullable(false)->comment('账户类型');
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
