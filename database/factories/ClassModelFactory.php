<?php

namespace Database\Factories;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    protected $model = ClassModel::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'schedule' => $this->faker->paragraph,
            'location' => $this->faker->address,
        ];
    }
}
