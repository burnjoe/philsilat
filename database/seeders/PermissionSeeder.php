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

        // Manage Events & Games
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'edit events']);
        Permission::create(['name' => 'delete events']);
        Permission::create(['name' => 'view games']);
        Permission::create(['name' => 'create games']);
        Permission::create(['name' => 'edit games']);
        Permission::create(['name' => 'delete games']);
        Permission::create(['name' => 'view teams']);
        Permission::create(['name' => 'drop teams']);
        Permission::create(['name' => 'generate matches']);

        Permission::create(['name' => 'manage events'])
            ->givePermissionTo([
                'view events',
                'create events',
                'edit events',
                'delete events',
                'view games',
                'create games',
                'edit games',
                'delete games',
                'view teams',
                'drop teams',
                'generate matches',
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

        // Participate Event
        Permission::create(['name' => 'join events']);
        Permission::create(['name' => 'leave events']);

        Permission::create(['name' => 'participate events'])
            ->givePermissionTo([
                'view events',
                'join events',
                'leave events',
            ]);
    }
}
