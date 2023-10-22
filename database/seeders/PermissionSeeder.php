<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Manage Categories
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'edit categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'manage categories'])
            ->givePermissionTo([
                'view categories',
                'create categories',
                'edit categories',
                'delete categories',
            ]);

        // Manage Accounts
        Permission::create(['name' => 'view accounts']);
        Permission::create(['name' => 'edit accounts']);
        Permission::create(['name' => 'delete accounts']);

        Permission::create(['name' => 'manage accounts'])
            ->givePermissionTo([
                'view accounts',
                'edit accounts',
                'delete accounts',
            ]);

        // Manage Codes
        Permission::create(['name' => 'view codes']);
        Permission::create(['name' => 'generate codes']);

        Permission::create(['name' => 'manage codes'])
            ->givePermissionTo([
                'view codes',
                'generate codes',
            ]);
    }
}
