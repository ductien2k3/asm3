<?php

namespace Database\Factories;

use App\Models\CoursePromotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoursePromotionFactory extends Factory
{
    protected $model = CoursePromotion::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 50),
            'promotions_id' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
