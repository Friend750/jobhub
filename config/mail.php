<?php

return [

    'default' => 'smtp', // Ensure SMTP is set as default

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'username' => 'friendsmoaha@gmail.com',
            'password' => 'cpjdavscikzjjfjo',
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],
    ],

    'from' => [
        'address' => 'friendsmoaha@gmail.com',
        'name' => 'friendsmoaha',
    ],

];
