<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        // Admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            Permission::create(['name' => 'users-create']),
            Permission::create(['name' => 'users-update']),
            Permission::create(['name' => 'users-delete']),
        ]);

        /**
         * Here you can create all the roles and permissinon needed for you application
         * Just folow the example with the $admin role above.
         */

        if (App::isLocal()) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password')
            ]);

            $user->assignRole(['admin']);
        }

    }
}
