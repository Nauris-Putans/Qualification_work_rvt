<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'userFree' => [
            'profile' => 'r,u'
        ],
        'userPro' => [
            'profile' => 'r,u',
        ],
        'userWebmaster' => [
            'profile' => 'r,u',
        ],
        'admin' => [
            'users' => 'c,r,u,d',
            'payments' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'member' => [
            'users' => 'r',
            'payments' => 'r',
            'profile' => 'r'
        ],
        'developer' => [
            'users' => 'r,u',
            'payments' => 'r,u',
            'profile' => 'r,u'
        ],
        'maintainer' => [
            'users' => 'c,r,u',
            'payments' => 'c,r,u',
            'profile' => 'c,r,u'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
