<?php

return [
    'database' => [
        'host' => '127.0.0.1', // lub 'localhost'
        'port' => 3306,
        'dbname' => 'lara_php',
        'charset' => 'utf8mb4',
        'username' => 'twoj_uzytkownik', // <-- ZMIEŃ TUTAJ
        'password' => 'twoje_mocne_haslo' // <-- ZMIEŃ TUTAJ
    ],
    'services' => [
        'prerender' => [
            'token' => '',
            'secret' => '',
        ],
    ],
];