<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $users = collect([
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'name' => 'Super Admin',
                'username' => 'SuperAdmin',
                "password" => bcrypt("password"),
                'email' => 'superadmin@admin.com',
                'phone' => '0987654321',
                'email_verified_at' => now(),
                'status' => true,
                'created_by' => 1,
                'role' => 'SuperAdmin'
            ],
            [
                'first_name' => 'Administrator',
                'last_name' => 'A',
                'name' => 'Administrator',
                'username' => 'administrator@admin.com',
                "password" => bcrypt("password"),
                'email' => 'administrator@admin.com',
                'phone' => '8031231232',
                'email_verified_at' => now(),
                'status' => true,
                'created_by' => 1,
                'role' => 'Administrator'
            ]
        ]);
        $permissions = Permission::all()->select('name')->toArray();

        $users->each(function ($user, $key) use ($permissions) {
            $User = $user;
            array_pop($User);
            $userId = User::create($User);
            $role = Role::where('name', $user['role'])->get()->first();
            $userId->assignRole([$role['id']]);
            $role->syncPermissions($permissions);
        });
    }
}
