<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_course_id' => $this->faker->numberBetween(1, 100),
            'payment_date' => $this->faker->date(),
            'amount' => $this->faker->randomFloat(2, 50, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
