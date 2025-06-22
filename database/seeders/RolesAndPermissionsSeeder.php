<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate(['name' => 'create products', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'update products', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'delete products', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'view products', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'view product detail', 'guard_name' => 'api']);

        // Crear permisos de categorías
        Permission::firstOrCreate(['name' => 'view categories', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'create categories', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'update categories', 'guard_name' => 'api']);
        Permission::firstOrCreate(['name' => 'delete categories', 'guard_name' => 'api']);

        // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        $user  = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'api']);

        // Asignar permisos al rol Admin
        $admin->givePermissionTo(Permission::pluck('name'));

        // Asignar permisos al rol User
        $user->givePermissionTo([
            'view products',
            'view product detail',
            'view categories'
        ]);

        // Crear usuario admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123456789'),
            ]
        );

        // Asignar rol admin
        $adminUser->assignRole('admin');

    }
}
