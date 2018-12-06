<?php

return [
    'general'      => 'Server exception',
    'unauthorized' => 'Action not allowed',

    'backend' => [
        'users' => [
            'create'                            => 'Error on user creation',
            'update'                            => 'Error on user updating',
            'delete'                            => 'Error on user deletion',
            'first_user_cannot_be_edited'       => 'You cannot edit super admin user',
            'first_user_cannot_be_disabled'     => 'Super admin user cannot be disabled',
            'first_user_cannot_be_destroyed'    => 'Super admin user cannot be deleted',
            'first_user_cannot_be_impersonated' => 'Super admin user cannot be impersonated',
            'cannot_set_superior_roles'         => 'You cannot attribute roles superior to yours',
        ],

        'roles' => [
            'create' => 'Error on role creation',
            'update' => 'Error on role updating',
            'delete' => 'Error on role deletion',
        ],

        'brands' => [
            'create' => 'Error on brand creation',
            'update' => 'Error on brand updating',
            'save'   => 'Error on brand saving',
            'delete' => 'Error on brand deletion',
        ],

        'categories' => [
            'create' => 'Error on category creation',
            'update' => 'Error on category updating',
            'save'   => 'Error on category saving',
            'delete' => 'Error on category deletion',
        ],
    ],

    'frontend' => [
        'user' => [
            'email_taken'       => 'That e-mail address is already taken.',
            'password_mismatch' => 'That is not your old password.',
            'delete_account'    => 'Error on account deletion.',
            'updating_disabled' => 'Account editing is disabled.',
        ],

        'auth' => [
            'registration_disabled' => 'Registration is disabled.',
        ],
    ],
];
