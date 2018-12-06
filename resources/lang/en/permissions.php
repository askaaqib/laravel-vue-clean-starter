<?php

return [
    'categories' => [
        'blog'   => 'Blog',
        'form'   => 'Forms',
        'access' => 'Access',
        'seo'    => 'SEO',
    ],

    'access' => [
        'backend' => [
            'display_name' => 'Backoffice access',
            'description'  => 'Can access to administration pages.',
        ],
    ],

    'view' => [
        'users' => [
            'display_name' => 'View users',
            'description'  => 'Can view users.',
        ],

        'roles' => [
            'display_name' => 'View roles',
            'description'  => 'Can view roles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'View own posts',
                'description'  => 'Can view own posts.',
            ],
        ],
    ],

    'create' => [
        'users' => [
            'display_name' => 'Create users',
            'description'  => 'Can create users.',
        ],

        'roles' => [
            'display_name' => 'Create roles',
            'description'  => 'Can create roles.',
        ],
    ],

    'edit' => [
        'users' => [
            'display_name' => 'Edit users',
            'description'  => 'Can edit users.',
        ],

        'roles' => [
            'display_name' => 'Edit roles',
            'description'  => 'Can edit roles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Edit own posts',
                'description'  => 'Can edit own posts.',
            ],
        ],
    ],

    'delete' => [
        'users' => [
            'display_name' => 'Delete users',
            'description'  => 'Can delete users.',
        ],

        'roles' => [
            'display_name' => 'Delete roles',
            'description'  => 'Can delete roles.',
        ],

        'own' => [
            'posts' => [
                'display_name' => 'Delete own posts',
                'description'  => 'Can delete own posts.',
            ],
        ],
    ],

    'publish' => [
        'posts' => [
            'display_name' => 'Publish posts',
            'description'  => 'Can manage posts publication.',
        ],
    ],

    'impersonate' => [
        'display_name' => 'Impersonate user',
        'description'  => 'Can take ownership of others user identities. Useful for tests.',
    ],
];
