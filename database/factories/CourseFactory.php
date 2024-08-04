<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl(640, 480, 'courses', true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 50, 1000),
            'location' => $this->faker->address,
            'schedule' => $this->faker->text(50),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
        ];
    }
}
