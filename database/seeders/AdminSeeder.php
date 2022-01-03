<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guards\Admin;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Admin 1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $role = Role::where(['name' => 'Super Admin', 'guard_name' => 'admin'])->first();
        $admin->assignRole($role);
        // User::factory()->count(10)->create();
    }
}
