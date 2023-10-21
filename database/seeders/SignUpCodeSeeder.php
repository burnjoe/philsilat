<?php

namespace Database\Seeders;

use App\Models\SignUpCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SignUpCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SignUpCode::factory(10)->create();
    }
}
