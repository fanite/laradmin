<?php

namespace Autodev\Index;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Events\Dispatcher;

class IndexServiceProvider extends ServiceProvider
{
    use Services;

    /**
     * 在注册后启动服务
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerViews();
        $this->offerPublishing();
        // $this->registerMiddlewares();
    }

    /**
     * 路由
     */
    protected function registerRoutes()
    {
        Route::group([
            'namespace' => 'Autodev\Index\Http\Controllers',
            'middleware' => ["web"],
        ], function () {
            $this->loadRoutesFrom(INDEX_PATH . '/routes/web.php');
        });
    }

    protected function registerEvents()
    {
        $events = $this->app->make(Dispatcher::class);
        foreach ($this->events as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }
    }

    /**
     * 数据库迁移
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom(INDEX_PATH . '/migrations');
    }

    /**
     * 视图
     */
    protected function registerViews()
    {
        $this->loadViewsFrom(INDEX_PATH . '/resources/views', 'index');
    }

    /**
     * 发布
     */
    protected function offerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                INDEX_PATH . '/dists' => public_path('vendor/index'),
            ], 'index-dists');

            $this->publishes([
                INDEX_PATH . '/config/index.php' => config_path('index.php'),
            ], 'index-config');
        }
    }

    /**
     * 中间件
     */
    protected function registerMiddlewares()
    {
        foreach ($this->middlewares as $key => $middleware) {
            $this->app->make('router')->aliasMiddleware($key, $middleware);
        }

        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app->make('router')->middlewareGroup($key, $middleware);
        }
    }

    /**
     *  在容器中注册绑定
     *
     * @return void
     */
    public function register()
    {
        if (!defined('INDEX_PATH')) {
            define('INDEX_PATH', realpath(__DIR__ . '/../'));
        }

        $this->configure();
        $this->registerServices();
        $this->registerCommands();
    }

    /**
     * 配置
     */
    protected function configure()
    {
        $this->mergeConfigFrom(INDEX_PATH . '/config/index.php', 'index');
    }

    protected function registerServices()
    {
        foreach ($this->services as $key => $value) {
            is_numeric($key)
                ? $this->app->singleton($value)
                : $this->app->singleton($key, $value);
        }
    }

    /**
     * 命令行注册
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                // BarCommand::class,
            ]);
        }
    }
}
