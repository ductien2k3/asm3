<?php

namespace Database\Factories;

use App\Models\UserClass;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserClassFactory extends Factory
{
    protected $model = UserClass::class;

    public function definition()
    {
        return [
            'class_model_id' => $this->faker->numberBetween(1, 20),
            'user_id' => $this->faker->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
