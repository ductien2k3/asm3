<?php

namespace Database\Factories;

use App\Models\UserCourse;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserCourseFactory extends Factory
{
    protected $model = UserCourse::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'course_id' => $this->faker->numberBetween(1, 50),
            'status' => $this->faker->randomElement(['enrolled', 'completed', 'dropped']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
