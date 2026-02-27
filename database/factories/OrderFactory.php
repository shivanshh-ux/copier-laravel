<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'plan_id' => Plan::factory(),
            'amount' => $this->faker->randomFloat(2, 500, 5000),
            'status' => $this->faker->randomElement(['pending', 'active', 'completed', 'cancelled']),
            'notes' => $this->faker->sentence(),
        ];
    }
}
