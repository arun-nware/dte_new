<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $roles = collect([
            ['name' => 'SuperAdmin', 'guard_name' => 'web'],
            ['name' => 'Administrator', 'guard_name' => 'web'],
            ['name' => 'Admin', 'guard_name' => 'web'],
            ['name' => 'HospitalAdmin', 'guard_name' => 'web'],
            ['name' => 'Maker', 'guard_name' => 'web'],
            ['name' => 'Checker', 'guard_name' => 'web'],
            ['name' => 'Approver', 'guard_name' => 'web'],
        ]);

        $roles->each(function($role){
            Role::create($role);
        });

    }
}
