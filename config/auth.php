<?php

return [

    'defaults' => [
        'guard' => 'warga',
        'passwords' => 'warga',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'warga' => [
            'driver' => 'session',
            'provider' => 'warga',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'petugas' => [
            'driver' => 'session',
            'provider' => 'petugas',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'warga' => [
            'driver' => 'eloquent',
            'model' => App\Models\Warga::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'petugas' => [
            'driver' => 'eloquent',
            'model' => App\Models\Petugas::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'warga' => [
            'provider' => 'warga',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
