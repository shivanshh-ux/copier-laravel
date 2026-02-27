<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    protected $model = Plan::class;

    public function definition(): array
    {
        $actualPrice = $this->faker->randomFloat(2, 500, 5000);
        return [
            'name' => $this->faker->randomElement(['Basic', 'Pro', 'Elite', 'Enterprise', 'Starter', 'Advanced', 'Gold']),
            'description' => $this->faker->paragraph(),
            'actual_price' => $actualPrice,
            'discounted_price' => $this->faker->boolean(70) ? $actualPrice * 0.8 : null,
            'duration_days' => $this->faker->randomElement([30, 90, 180, 365]),
            'is_active' => true,
        ];
    }
}
