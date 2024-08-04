<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CoursePromotion;

class CoursePromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CoursePromotion::factory()->count(10)->create();
    }
}
