<?php

declare(strict_types=1);

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://github.com/codeigniter4/shield/blob/develop/docs/quickstart.md#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Complete control of the site.',
        ],
        'sellers' => [
            'title'       => 'Sellers',
            'description' => 'Can manage their own shop.',
        ],
        'customers' => [
            'title'       => 'Customers',
            'description' => 'General users of the site. Often customers.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'dashboard.access'    => 'Can access the sites admin area',

        'user.create'        => 'Can create new non-admin users',
        'user.edit'          => 'Can edit existing non-admin users',
        'user.delete'        => 'Can delete existing non-admin users',
        'user.roles'         => 'Can update roles for users',

        'profile.view'        => 'Can view a user profile',
        'profile.create'      => 'Can create a user profile',
        'profile.edit'        => 'Can edit a user profile',
        'profile.delete'      => 'Can delete a user profile',

        'paypal.view'        => 'Can view a user profile',
        'paypal.create'      => 'Can create a user profile',
        'paypal.edit'        => 'Can edit a user profile',
        'paypal.delete'      => 'Can delete a user profile',

        'product.view'        => 'Can view products',
        'product.edit'        => 'Can edit a product',
        'product.add'         => 'Can add a product',
        'product.delete'      => 'Can delete a product',

    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'dashboard.*',
            'profile.*',
            'user.*',
            'profile.*',
            'paypal.*',
            'product.*',
        ],
        'sellers' => [
            'dashboard.access',
            'profile.edit',
            'paypal.edit',
            'product.*',
        ],
        'customers' => [],
    ];
}
