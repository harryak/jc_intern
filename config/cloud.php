<?php

return [
    'uri' => env('CLOUDSHARE_OCS_URI', 'localhost/'), // trailing slash required
    'shares' => [
        'users' => [
            'requires_admin' => false,
            'username' => env('CLOUDSHARE_USERS_USERNAME', ''),
            'password' => env('CLOUDSHARE_USERS_PASSWORD', ''),
            'folders' => [
                1 => [
                    'path' => '/Übe-Dateien',
                    'public_upload' => 'false',
                    'permissions'   => '1', // read only
                    ],
                2 => [
                    'path' => '/Für Mitglieder',
                    'public_upload' => 'false',
                    'permissions'   => '1', // read only
                    ],
                3 => [
                    'path' => '/Sänger-Cloud',
                    'public_upload' => 'true',
                    'permissions'   => '15', // grant all permissions except sharing
                ]
            ],
        ],
        'admins' => [
            'requires_admin' => true,
            'username' => env('CLOUDSHARE_ADMINS_USERNAME', ''),
            'password' => env('CLOUDSHARE_ADMINS_PASSWORD', ''),
            'folders' => [
                1 => [
                    'path' => '/Für Vorstände',
                    'public_upload' => 'true',
                    'permissions'   => '15' // grant all permissions except sharing
                ]
            ],
        ]
    ]
];