<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserClass;

class UserClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserClass::factory()->count(10)->create();
    }
}
