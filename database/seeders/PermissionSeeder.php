<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user_role = Role::create(['name' => 'user']);
        $admin_role = Role::create(['name' => 'admin']);

        $permission = Permission::create(['name' => 'Role view', 'group' => 'role']);
        $permission = Permission::create(['name' => 'Role create', 'group' => 'role']);
        $permission = Permission::create(['name' => 'Role update', 'group' => 'role']);
        $permission = Permission::create(['name' => 'Role delete', 'group' => 'role']);

        $permission = Permission::create(['name' => 'User view', 'group' => 'user']);
        $permission = Permission::create(['name' => 'User create', 'group' => 'user']);
        $permission = Permission::create(['name' => 'User update', 'group' => 'user']);
        $permission = Permission::create(['name' => 'User delete', 'group' => 'user']);

        $admin->assignRole($admin_role);
        $user->assignRole($user_role);

        $admin_role->givePermissionTo(Permission::all());
    }
}
