<?php namespace Jozef\Userapi;

use Backend;
use System\Classes\PluginBase;

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
