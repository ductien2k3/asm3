<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    public function definition()
    {
        return [
            'course_id' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'video_url' => $this->faker->url,
        ];
    }
}
