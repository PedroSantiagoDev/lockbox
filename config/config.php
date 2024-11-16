<?php

return [
    'database' => [
        'driver' => 'sqlite',
        'database' => base_path('database/database.sqlite')

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
        'first_key' => 'Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=',
        'second_key' => 'EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w=='
    ]
];
