<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //! Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $customerRole = Role::create(['name' => 'customer']);
        $storeOwnerRole = Role::create(['name' => 'store_owner']);

        //! Create permissions
        $permissions = [
            'manage users',
            'view orders',
            'manage store',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //! Assign permissions to roles
        $adminRole->givePermissionTo(['manage users', 'view orders']);
        $storeOwnerRole->givePermissionTo(['manage store', 'view orders']);
    }
}
