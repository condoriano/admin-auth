<?php namespace Condoriano\AdminAuth\Providers;

use Condoriano\AdminAuth\AdminGuard;
use Condoriano\AdminAuth\AdminUserProvider;
use Condoriano\AdminAuth\Middleware\Authenticate;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class AdminAuthServiceProvider extends ServiceProvider {

    public function boot(Router $router)
    {
        parent::boot($router);

        $this->publishes([
             __DIR__.'/../../assets' => public_path('css/admin'),
         ], 'public');

        $this->publishes([
             __DIR__.'/../../migrations/' => database_path('/migrations')
         ], 'migrations');

        $this->app['view']->addNamespace('admin_auth', __DIR__.'/../../views');
        $this->app['router']->middleware('admin.auth', Authenticate::class);

        if (! $this->app['request']->is('admin*'))
            return;

        $adminUserClass = $this->app['config']->get('auth.admin_model');

        $this->app['config']->set('auth.driver', 'eloquent.admin');
        $this->app['config']->set('auth.model', $adminUserClass);
        $this->app['config']->set('auth.table', 'admin_users');

        $this->app['auth']->extend('eloquent.admin', function () use ($adminUserClass)
        {
            return new AdminGuard(new AdminUserProvider($this->app['hash'], new $adminUserClass), $this->app['session.store']);
        });
    }

    public function map(Router $router)
    {
        $router->group(['namespace' => 'Condoriano\AdminAuth\Controllers', 'prefix' => 'admin'], function($router)
        {
            get('login', 'AuthController@index');
            post('login', 'AuthController@authenticate');
            get('logout', 'AuthController@logout');
        });
    }

    public function register()
    {

    }
}
