<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Coach;
use COM;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = Admin::all();
        $coaches = Coach::all();

        foreach ($admins as $admin) {
            if ($admin->last_name == 'Sabana') {
                User::factory()->create([
                    'email' => 'sabanajholo@gmail.com',
                    'password' => bcrypt('burnjoe25'),
                    'status' => 'ACTIVE',
                    'profileable_id' => $admin->id,
                    'profileable_type' => Admin::class,
                ])->assignRole('admin');
            } else {
                User::factory()->create([
                    'profileable_id' => $admin->id,
                    'profileable_type' => Admin::class,
                ])->assignRole('admin');
            }
        }

        foreach ($coaches as $coach) {
            if ($coach->last_name == 'Derla') {
                User::factory()->create([
                    'email' => 'derlajulius@gmail.com',
                    'password' => bcrypt('password'),
                    'status' => 'ACTIVE',
                    'profileable_id' => $coach->id,
                    'profileable_type' => Coach::class,
                ])->assignRole('coach');
            } else if ($coach->last_name == 'Ferreras') {
                User::factory()->create([
                    'email' => 'ferrerasvinceaustin@gmail.com',
                    'password' => bcrypt('password'),
                    'status' => 'ACTIVE',
                    'profileable_id' => $coach->id,
                    'profileable_type' => Coach::class,
                ])->assignRole('coach');
            } else {
                User::factory()->create([
                    'profileable_id' => $coach->id,
                    'profileable_type' => Coach::class,
                ])->assignRole('coach');
            }
        }
    }
}
