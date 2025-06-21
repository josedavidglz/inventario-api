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
        // Permisos para productos
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'view product detail']);

        // Permisos para categorías
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

         // Crear roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Asignar permisos al rol Admin
        $admin->givePermissionTo([
            'create products',
            'update products',
            'delete products',
            'create categories',
            'update categories',
            'delete categories',
            'register users',
            'view products',
            'view product detail',
        ]);

        // Asignar permisos al rol User
        $user->givePermissionTo([
            'view products',
            'view product detail',
        ]);

    }
}
