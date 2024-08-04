<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserCourse;

class UserCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCourse::factory()->count(10)->create();
    }
}
