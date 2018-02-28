<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'name' => 'Test User',
            'email' => 'produccion@ivirtual.la',
            'password' => bcrypt('password')
        ]);


        $administrator = \App\Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'Administrator role.'
        ]);

        $usersManager = \App\Role::create([
            'name' => 'users_manager',
            'display_name' => 'Users Manager',
            'description' => 'Manager of the users role.'
        ]);

        \App\Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'User Role.'
        ]);

        $administrator->permissions()->saveMany([
            new \App\Permission([
                'name' => 'roles-create',
                'display_name' => 'Create Roles',
                'description' => 'Create the roles permission.'
            ]),
            new \App\Permission([
                'name' => 'roles-edit',
                'display_name' => 'Edit Roles',
                'description' => 'Edit the roles permission.'
            ]),
            new \App\Permission([
                'name' => 'roles-delete',
                'display_name' => 'Delete Roles',
                'description' => 'Delete the roles permission.'
            ])
        ]);

        $usersManager->permissions()->saveMany([
            new \App\Permission([
                'name' => 'users-create',
                'display_name' => 'Create Users',
                'description' => 'Create the users permission.'
            ]),
            new \App\Permission([
                'name' => 'users-update',
                'display_name' => 'Update Users',
                'description' => 'Update the users permission.'
            ]),
            new \App\Permission([
                'name' => 'users-delete',
                'display_name' => 'Delete Users',
                'description' => 'Delete the users permission.'
            ])
        ]);

        $administrator->attachPermissions($usersManager->permissions()->pluck('id'));

        $user->attachRole($administrator->id);

    }
}
