<?php namespace Jozef\Userapi;

use Backend;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Contracts\Auth\Factory;
use System\Classes\PluginBase;
use Tymon\JWTAuth\Providers\LaravelServiceProvider;

/**
 * Userapi Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Userapi',
            'description' => 'No description provided yet...',
            'author'      => 'Jozef',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {   
        config([
            "jwt" => config("jozef.userapi::jwt")
        ]);
        $this->app->register(AuthServiceProvider::class);
        $this->app->alias("auth", AuthManager::class);
        $this->app->alias("auth", Factory::class);

        $this->app->register(LaravelServiceProvider::class);
        $this->app->alias("JWTAuth", \Tymon\JWTAuth\Facades\JWTAuth::class);
        $this->app->alias("JWTFactory", \Tymon\JWTAuth\Facades\JWTFactory::class);
        $this->app["router"]->aliasMiddleware("auth", Authenticate::class);
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Jozef\Userapi\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jozef.userapi.some_permission' => [
                'tab' => 'Userapi',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'userapi' => [
                'label'       => 'Userapi',
                'url'         => Backend::url('jozef/userapi/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jozef.userapi.*'],
                'order'       => 500,
            ],
        ];
    }
}
