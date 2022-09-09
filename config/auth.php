<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => '\RainLab\User\Models\User',
        ],
    ],

    'throttle' => [
        /*
        |--------------------------------------------------------------------------
        | Enable throttling of Backend authentication attempts
        |--------------------------------------------------------------------------
        |
        | If set to true, users will be given a limited number of attempts to sign
        | in to the Backend before being blocked for a specified number of minutes.
        |
         */
        'enabled' => true,

        /*
        |--------------------------------------------------------------------------
        | Failed Authentication Attempt Limit
        |--------------------------------------------------------------------------
        |
        | Number of failed attempts allowed while trying to authenticate a user.
        |
         */
        'attemptLimit' => 5,

        /*
        |--------------------------------------------------------------------------
        | Suspension Time
        |--------------------------------------------------------------------------
        |
        | The number of minutes to suspend further attempts on authentication once
        | the attempt limit is reached.
        |
         */
        'suspensionTime' => 15,
    ],

];
