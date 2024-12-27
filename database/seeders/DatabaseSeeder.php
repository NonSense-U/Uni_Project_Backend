<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        // User::factory(10)->create();
        $user = User::factory()->create([
            'username' => 'Malek',
            'email' => 'akikon@gmail.com',
            'password' => Hash::make('BeAwesome'),
        ]);
        $role = Role::firstOrCreate(['name' => 'admin']);
        $user->assignRole($role);

        $this->call(TransactionSeeder::class);

    }
}
