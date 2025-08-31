<?php

return [

    'default' => 'smtp', // Ensure SMTP is set as default

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'yemenin2025@gmail.com',
            'password' => 'nyusohlmvfttbpcg',
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],
    ],

    'from' => [
        'address' => 'yemenin2025@gmail.com',
        'name' => 'Yemen In 2025',
    ],

];
