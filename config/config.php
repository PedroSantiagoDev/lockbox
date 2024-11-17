<?php

return [
    'database' => [
        'driver' => 'sqlite',
        'database' => base_path('database/database.sqlite'),

        //config db mysql
        /*
        'drive' => 'mysql',
        'host' => '127.0.0.1',
        'port' => 3306,
        'dbname' => 'lockbox',
        'user' => 'root',
        'charset' => 'utf8mb4'
        */
    ],
    'security' => [
        'first_key' => env('FIRST_KEY'),
        'second_key' => env('SECOND_KEY'),
    ],
];
