<?php

namespace Database\Factories;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    protected $model = Promotion::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('PROMO###')),
            'description' => $this->faker->paragraph,
            'discount_percentage' => $this->faker->randomFloat(2, 1, 100),
            'start_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 month'),
        ];
    }
}
