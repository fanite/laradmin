<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('staff_code', 100)->nullable(false)->after('id')->comment('工号');
            $table->integer('phone')->after('email')->comment('电话号码');
            $table->enum('gender', ['male', 'female'])->nullable()->after('phone')->comment('性别');
            $table->text('avatar')->after('gender')->comment('头像地址');
            $table->string('work_place', 100)->after('avatar')->comment('工作地点');
            $table->ipAddress('last_ip')->after('work_place')->comment('最后登录的IP地址');
            $table->boolean('is_admin')->after('last_ip')->comment('超级账户');
            $table->string('user_type', 100)->nullable(false)->after('is_admin')->comment('账户类型');
            $table->unique('staff_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['staff_code', 'phone', 'gender', 'avatar', 'last_ip', 'work_place', 'is_admin', 'user_type']);
        });
    }
}
