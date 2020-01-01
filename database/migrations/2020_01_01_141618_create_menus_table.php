<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent')->default(0);
            $table->string('name')->unique()->comment('菜单名字');
            $table->string('title')->comment('菜单标题');
            $table->string('path')->nullable(true)->unique()->comment('路由路径');
            $table->string('compoent')->nullable(true)->comment('组件路径');
            $table->string('alias')->nullable(true)->comment('路由路径别名');
            $table->string('redirect')->nullable(true)->comment('路由重定向路径');
            $table->json('meta')->nullable(true)->comment('路由元信息');
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
        Schema::dropIfExists('menus');
    }
}
